<?php

namespace App\Repositories;

use App\CustomMails;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CustomMailsRepository
 * @package App\Repositories
 * @version February 17, 2021, 12:46 pm -03
 *
 * @method CustomMails findWithoutFail($id, $columns = ['*'])
 * @method CustomMails find($id, $columns = ['*'])
 * @method CustomMails first($columns = ['*'])
*/
class CustomMailsRepository extends BaseRepository
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
        return CustomMails::class;
    }
}
