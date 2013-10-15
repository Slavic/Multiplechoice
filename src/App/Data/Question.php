<?php
class App_Data_Question extends App_Data_Base
{
    const   VIEW_CLASS  = 'viewQuestion';
    const   VIEW_PK     = 'UID';

    private $_arrDependencies   = array();

    public function getAllanswers() {
        return viewAnswer::getAllAnswersByQuestionUID($this->getUID(), false);
    }

    public function addAnswer(App_Data_Answer $objAnswer) {
        $objAnswer->settblquestion_UID($this->getUID());

        $this->_arrDependencies[] = $objAnswer;
    }

    public function doFullupdate($blnDependencies = false) {
        if($blnDependencies) {
            foreach($this->_arrDependencies as $objDependence) {
                $objDependence->doFullupdate();
            }
        }
        
        parent::doFullupdate();
    }

    protected function _getEmpryarray() {
        return array(
            'strQuestion'           => '',
            'lngCountshowed'        => 0,
            'lngOpttime'            => 0,
            'tbldifficulty_UID'     => NULL,
            'tblbackenduser_UID'    => NULL
        );
    }
}