<?php

namespace backend\forms\common;

use backend\common\model\AbstractFormModel;
use backend\db\models\File;
use backend\db\repositories\FileRepositoryInterface;

/**
 * Class FileFormModel
 * @package backend\forms\common
 */
class FileFormModel extends AbstractFormModel
{

    /**
     * @var string
     */
    public $file;

    /**
     * @var string
     */
    public $extansions;
    
    /**
     * @var string
     */
    public $path;

    /**
     * @var \backend\db\repositories\FileRepositoryInterface
     */
    private $fileRepository;

    public function __construct(
        FileRepositoryInterface $fileRepository
    ) {
        parent::__construct();

        $this->fileRepository = $fileRepository;
    }

    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => $this->extansions],
        ];
    }

    public function upload()
    {
        $nextId = $this->uuidGenerator->generate();

        $name = $this->file->baseName . '_' . strtotime('now'). '.' . $this->file->extension;
        $file = new File;
        $file->id = $nextId;
        $file->name = $name;
        $file->path = '/' . $this->path;
        $file->type = $this->file->type;

        $this->file->saveAs($this->path . $name);

        if (!$this->fileRepository->insert($file)) {
            throw new \ErrorException('Failed to insert file.');
        }

        $result = array(
            'id' => $file->id,
            'name' => $name
        );

        return $result;
    }
}
