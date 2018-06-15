<?php
namespace app\models\search;

use app\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;

class UserSearch extends Model{

    public $fio;

    public $register_source;

    public $country;

    public $age;

    public $gender;

    public $startRegDate;

    public $endRegDate;

    public function rules()
    {
        return [
            [['fio', 'register_source', 'country', 'age', 'gender', 'startRegDate', 'endRegDate'], 'safe']
        ];
    }

    public function search($params)
    {
        $query = User::find()
            ->select(['user.*', '(SELECT COUNT(worksheets.id) FROM worksheets WHERE worksheets.user_id = user.id) worksheetsCount'])
            ->where(['!=', 'username', 'admin'])
            ->leftJoin('user_data ud', 'ud.user_id = user.id');
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'fio' => [
                    'asc' => ['last_name' => SORT_ASC, 'first_name' => SORT_ASC],
                    'desc' => ['last_name' => SORT_DESC, 'first_name' => SORT_DESC],
                    'default' => SORT_ASC
                ],
                'register_source',
                'country',
                'age' => [
                    'asc' => ['birthday' => SORT_ASC],
                    'desc' => ['birthday' => SORT_DESC],
                    'default' => SORT_ASC
                ],
                'gender',
                'created_at',
                'worksheetsCount',
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }


        if (!empty($startDateReg) && !empty($finishDateReg)) {
            $query->andWhere(['between', 'created_at', strtotime($startDateReg), (strtotime($finishDateReg) + 86400)]);
        }

        if (!empty($this->fio)){
            $query->andWhere(['OR',
                ['LIKE', 'ud.last_name', $this->fio],
                ['LIKE', 'ud.first_name', $this->fio],
                ['LIKE', 'ud.second_name', $this->fio]
            ]);
        }

        if (!empty($this->country)){
            $query->andWhere(['country' => $this->country]);
        }

        if (!empty($this->gender)){
            $query->andWhere(['gender' => $this->gender]);
        }

        if (!empty($this->startRegDate) && !empty($this->endRegDate)) {
            $query->andWhere(['between', 'created_at', strtotime($this->startRegDate), (strtotime($this->endRegDate) + 86400)]);
        }

        if (!empty($this->register_source)){
            $query->andWhere(['register_source' => $this->register_source]);
        }

        if (!empty($this->age)){
            $startDate = strtotime($this->age+1 . ' years ago');
            $endDate = $startDate+86400*365;
            $query->andWhere(['between', 'birthday', $startDate, $endDate]);
        }

        return $dataProvider;
    }

    /**
     * Диапазон возрастов для фильтра
     * @return array
     */
    public function ageRange()
    {
        $start = 16;
        $end = 80;
        $result = [];
        for ($i = $start; $i <= $end; $i++){
            $result[$i] = $i;
        }

        return $result;
    }
}