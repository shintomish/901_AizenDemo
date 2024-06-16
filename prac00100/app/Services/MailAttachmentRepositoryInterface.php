<?php

namespace App\Services;

interface MailAttachmentRepositoryInterface
{
    /**
     * @param file $putFileInfo
     * @return fileName|filePath
     */
    public function saveFile($putFileInfo);
}
