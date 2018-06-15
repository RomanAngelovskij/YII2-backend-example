<?php
namespace app\models\search;

use app\models\User;
use app\models\Worksheets;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class WorksheetSearch extends Model{

    public $status;

    public $country;

    public $user;

    public $sum;

    public $days;

    public $startUpdatedAt;

    public $endUpdatedAt;

    public function rules()
    {
        return [
            [['status', 'country', 'user', 'sum', 'days', 'startUpdatedAt', 'endUpdatedAt'], 'safe']
        ];
    }

    public function search($params)
    {
        $query = Worksheets::find()
            ->leftJoin('worksheetsamples ws', 'ws.id = worksheetsample_id')
            ->leftJoin('user_data ud', 'ud.user_id = worksheets.user_id');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC]]
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'user' => [
                    'asc' => ['last_name' => SORT_ASC, 'first_name' => SORT_ASC],
                    'desc' => ['last_name' => SORT_DESC, 'first_name' => SORT_DESC],
                    'default' => SORT_ASC
                ],
                'status' => [
                    'asc' => ['status_id' => SORT_ASC],
                    'desc' => ['status_id' => SORT_DESC],
                    'default' => SORT_ASC
                ],
                'updated_at',
                'country',
                'sum' => [
                    'asc' => ['max_sum' => SORT_ASC],
                    'desc' => ['max_sum' => SORT_DESC],
                    'default' => SORT_ASC
                ],
                'days',
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }


        if (!empty($startDateReg) && !empty($finishDateReg)) {
            $query->andWhere(['between', 'created_at', strtotime($startDateReg), (strtotime($finishDateReg) + 86400)]);
        }

        if (!empty($this->country)){
            $query->andWhere(['country_id' => $this->country]);
        }

        if (!empty($this->status)){
            $query->andWhere(['status_id' => $this->status]);
        }

        if (!empty($this->startUpdatedAt) && !empty($this->endUpdatedAt)) {
            $query->andWhere(['between', 'updated_at', strtotime($this->startUpdatedAt), (strtotime($this->endUpdatedAt) + 86400)]);
        }

        if (!empty($this->user)){
            $query->andWhere(['OR',
                ['LIKE', 'ud.last_name', $this->user],
                ['LIKE', 'ud.first_name', $this->user],
                ['LIKE', 'ud.second_name', $this->user]
            ]);
        }

        if (!empty($this->sum)){
            $query->andWhere(['>=', 'min_sum', $this->sum]);
        }

        if (!empty($this->days)){
            $query->andWhere(['days' => $this->days]);
        }

        if (!empty($this->age)){
            $startDate = strtotime($this->age+1 . ' years ago');
            $endDate = $startDate+86400*365;
            $query->andWhere(['between', 'birthday', $startDate, $endDate]);
        }

        return $dataProvider;
    }
}