<?php

use App\Services\FileService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('local');
    }

    public function testUploadValidTextFile()
    {
        $file = UploadedFile::fake()->create('test.txt', 100);
        $path = 'uploads';
        $fileService = new FileService($path);

        $result = $fileService->upload([$file]);

        $this->assertTrue($result);
        Storage::disk('local')->assertExists($path . '/' . $file->getClientOriginalName());
    }

    public function testUploadInvalidFile()
    {
        $file = UploadedFile::fake()->create('test.jpg', 100);
        $path = 'uploads';
        $fileService = new FileService($path);

        $result = $fileService->upload([$file]);

        $this->assertFalse($result);
        Storage::disk('local')->assertMissing($path . '/' . $file->getClientOriginalName());
    }

    public function testUploadTooLargeFile()
    {
        // 20MB以上のファイルを作成
        $file = UploadedFile::fake()->create('test.txt', 20000);
        $path = 'uploads';
        $fileService = new FileService($path);

        $result = $fileService->upload([$file]);

        $this->assertFalse($result);
        Storage::disk('local')->assertMissing($path . '/' . $file->getClientOriginalName());
    }

    public function testReadOldTypeFile()
    {
        $content = "Title 1……Detail 1\r\nTitle 2……Detail 2";
        Storage::disk('local')->put('uploads/test.txt', $content);
        $path = 'uploads';
        $fileService = new FileService($path);

        $result = $fileService->read();

        $expected = [
            ['title' => 'Title 1', 'summary' => '', 'detail' => 'Detail 1'],
            ['title' => 'Title 2', 'summary' => '', 'detail' => 'Detail 2'],
        ];
        $this->assertEquals($expected, $result);
        Storage::disk('local')->assertMissing('uploads/test.txt');
    }

    public function testReadNewTypeFile()
    {
        $content = "【タイトル】\nTitle\n\n【総論】\nSummary\n\n【本文】\nDetail";
        Storage::disk('local')->put('uploads/test.txt', $content);
        $path = 'uploads';
        $fileService = new FileService($path);

        $result = $fileService->read();

        $expected = [
            ['title' => 'Title', 'summary' => 'Summary', 'detail' => 'Detail'],
        ];
        $this->assertEquals($expected, $result);
        Storage::disk('local')->assertMissing('uploads/test.txt');
    }
}
