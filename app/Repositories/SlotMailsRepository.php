<?php

namespace App\Repositories;

use App\SlotMails;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CustomMailsRepository
 * @package App\Repositories
 * @version February 17, 2021, 12:46 pm -03
 *
 * @method SlotMails findWithoutFail($id, $columns = ['*'])
 * @method SlotMails find($id, $columns = ['*'])
 * @method SlotMails first($columns = ['*'])
*/
class SlotMailsRepository extends BaseRepository
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
        return SlotMails::class;
    }
}
