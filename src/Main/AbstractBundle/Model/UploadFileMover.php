<?php

namespace Main\AbstractBundle\Model;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Description of UploadFileMover
 *
 * @author Manoj
 */
class UploadFileMover {

    public function moveUploadedFile(UploadedFile $file, $uploadBasePath) {
        $originalName = $file->getFilename();
        // use filemtime() to have a more determenistic way to determine the subpath, otherwise its hard to test.
       // $relativePath = date('Y-m', filemtime($file->getPath()));
        $targetFileName = DIRECTORY_SEPARATOR . $originalName;
        $targetFilePath = $uploadBasePath . DIRECTORY_SEPARATOR . $targetFileName;
        $ext = $file->getExtension();
        $i=1;
        while (file_exists($targetFilePath) && md5_file($file->getPath()) != md5_file($targetFilePath)) {
            if ($ext) {
                $prev = $i == 1 ? "" : $i;
                $targetFilePath = $targetFilePath . str_replace($prev . $ext, $i++ . $ext, $targetFilePath);
                
            } else {
                $targetFilePath = $targetFilePath . $i++;
            }
        }
        $imageDetails = explode('.', $file->getClientOriginalName());

        $targetDir = $uploadBasePath . DIRECTORY_SEPARATOR ;
        if (!is_dir($targetDir)) {
            $ret = touch($targetDir . '.' . $imageDetails[1], umask(), true);
            if (!$ret) {
                throw new \RuntimeException("Could not create target directory to move temporary file into.");
            }
        }
        $fileTobeMoved = basename($targetFilePath . strtotime(date('Y-m-d H:s:i')). '.' . $imageDetails[1]);
        $file->move($targetDir, $fileTobeMoved);

        return str_replace($uploadBasePath . DIRECTORY_SEPARATOR, "", $targetFilePath . strtotime(date('Y-m-d H:s:i'))) . '.' . $imageDetails[1];
    }

}

?>
