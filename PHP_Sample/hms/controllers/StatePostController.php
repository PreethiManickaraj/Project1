<?php

class StatePostController extends Controller
{
    protected $staffData;
    public function __construct()
    {
        $this->state = new StateData();

    }
    
    public function process($params)
    {
        $countryId = $_GET['country_id'] ?? null;

        $stateHtml = '<option value="">Please  Select</option>';
        if ($countryId) {
            $stateDetails = $this->state->getStateByCountry($countryId);
            while ($row = $stateDetails->fetch(PDO::FETCH_ASSOC)) {
                $stateHtml .= '<option value="'.$row[StateData::STATE_NAME].'">'.$row[StateData::STATE_NAME].'</option>';
            }
        }
        echo $stateHtml;
    }
}