<?php

namespace App\Repositories;

use App\SlotMailContents;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SlotMailContentsRepository
 * @package App\Repositories
 * @version February 17, 2021, 12:46 pm -03
 *
 * @method SlotMailContents findWithoutFail($id, $columns = ['*'])
 * @method SlotMailContents find($id, $columns = ['*'])
 * @method SlotMailContents first($columns = ['*'])
*/
class SlotMailContentsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre' => 'like',
        'template' => 'like'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SlotMailContents::class;
    }
}
