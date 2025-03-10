<?php
class Calculator {
    public function calc($operator, $num1 = null, $num2 = null) {
        if (!$this->isValidOperator($operator)) {
            return "Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.<br>";
        }

        if (!is_numeric($num1) || !is_numeric($num2)) {
            return "Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.<br>";
        }

        switch ($operator) {
            case '+':
                return "The calculation is $num1 + $num2 The answer is " . $this->add($num1, $num2) . "<br>";
            case '-':
                return "The calculation is $num1 - $num2 The answer is " . $this->subtract($num1, $num2) . "<br>";
            case '*':
                return "The calculation is $num1 * $num2 The answer is " . $this->multiply($num1, $num2) . "<br>";
            case '/':
                return $this->divide($num1, $num2);
        }
    }

    private function isValidOperator($operator) {
        return in_array($operator, ['+', '-', '*', '/']);
    }

    private function add($num1, $num2) {
        return $num1 + $num2;
    }

    private function subtract($num1, $num2) {
        return $num1 - $num2;
    }

    private function multiply($num1, $num2) {
        return $num1 * $num2;
    }

    private function divide($num1, $num2) {
        if ($num2 == 0) {
            return "The calculation is $num1 / $num2 The answer cannot divide a number by zero" . "<br>";
        }
        return "The calculation is $num1 / $num2 The answer is " . ($num1 / $num2) . "<br>";
    }
}
?>


