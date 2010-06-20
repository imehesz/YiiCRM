<?php
class DateCompareValidator extends CValidator
{

        public $allowEmpty=true;
        public $compareType='greaterThan';
//        public $compareDate=date('Y-m-d');
        

    protected function validateAttribute($model,$attribute) {

                if(empty($model->$attribute) && $this->allowEmpty) {
                        return;
                }
                
                $modelTimestamp = strtotime($model->$attribute);
                $compareTimestamp = strtotime($this->compareDate);
                
                if($modelTimestamp === false) {
                $errorMessage = "This value does not appear to be a validate date.";
                $model->addError($attribute,$errorMessage);
                return false;
                }
                
                if($compareTimestamp === false) {
                throw new Exception('Invalid comparison date sent to DateCompareValidator.');
                }
                
                if($this->compareType === 'greaterThan') {
                        if($modelTimestamp > $compareTimestamp) {
                                return true;
                        }
                $errorMessage = "This value must be greater than {$this->compareDate}.";
                $model->addError($attribute,$errorMessage);
                return false;
                } else if($this->compareType === 'lessThan') {
                        if($modelTimestamp < $compareTimestamp) {
                                return true;
                        }
                $errorMessage = "This value must be less than {$this->compareDate}.";
                $model->addError($attribute,$errorMessage);
                return false;
            } else {
                throw new Exception("Unsupported date comparison type sent to DateCompareValidator.");
            }
        
    }
}

