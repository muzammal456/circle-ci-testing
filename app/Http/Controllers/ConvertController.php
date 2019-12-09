<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use NcJoes\OfficeConverter\OfficeConverter;
class ConvertController extends Controller
{
    public function file()
    {
        return view('upload_file');
    }
    public function wordToPdf(Request $request)
    {
        $this->validate($request,[
            'file' => 'required|mimes:doc,docx',
        ]);

        $path = 'word';
        $file = $this->fileUpload($request->file, $path);
        $fullName = $file[0];
        $fileName = $file[1];
        $filePath = $file[2];

        $converter = new OfficeConverter(public_path($path.'/'.$fullName));

        $getPdfFile = $converter->convertTo($fileName.'.pdf', public_path('word-to-pdf')); //generates pdf file in same directory as test-file.docx

//        $fullPath = public_path($path.)
        return redirect()->back()->with(['success'=>'File Has been converted', 'fileName'=>$fileName]);
    }
    public function fileUpload($file, $path)
    {
        $fileName = time().'_'.$file->getClientOriginalName();
        $fileName = explode('.',$fileName)[0];

        $extension = $file->getClientOriginalExtension();
        $fullName = $fileName.'.'.$extension;

        $path = public_path($path);
        \File::isDirectory($path) or \File::makeDirectory($path, 0775, true, true);

        $file->move($path . '/' , $fullName);
        return [$fullName, $fileName, $path];
    }
    public function txtToJson()
    {
        $myfile     = fopen("Hemp_Licenses.txt", "r") or die("Unable to open file!");
        $file_data  =  fread($myfile,filesize("Hemp_Licenses.txt"));
//        dd(gettype($file_data));
        echo json_encode($file_data);
        fclose($myfile);
    }
}
