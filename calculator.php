<?php

	echo "\n3: ".calculate("(23 + 7)/(13 - 3)");
	echo "\n3: ".calculate("(120 / (1 + 9 / 3) / 10");
	echo "\nerr: ".calculate("22 + (1");
	echo "\nerr: ".calculate("22) + 1");
	echo "\n3: ".calculate("(23 + 7)/(13 - 3)");
	echo "\n3: ".calculate("(23 + 7)/(13 - 3)");
	echo "\n3: ".calculate("(23 + 7)/(13 - 3)");
	echo "\n3: ".calculate("(23 + 7)/(13 - 3)");
	echo "\n3: ".calculate("(23 + 7)/(13 - 3)");
	echo "\n3: ".calculate("(23 + 7)/(13 - 3)");
	echo "\n";

	function calculate($exp) {
		return calculate_rpn(mathexp_to_rpn($exp));
	}

	function calculate_rpn($rpnexp) {
		$stack = array();
		foreach($rpnexp as $item) {
			if (is_operator($item)) {
				if ($item == '+') {
					$j = array_pop($stack);
					$i = array_pop($stack);
					array_push($stack, $i + $j);
				}
				if ($item == '-') {
					$j = array_pop($stack);
					$i = array_pop($stack);
					array_push($stack, $i - $j);
				}
				if ($item == '*') {
					$j = array_pop($stack);
					$i = array_pop($stack);
					array_push($stack, $i * $j);
				}
				if ($item == '/') {
					$j = array_pop($stack);
					$i = array_pop($stack);
					array_push($stack, $i / $j);
				}
				if ($item == '%') {
					$j = array_pop($stack);
					$i = array_pop($stack);
					array_push($stack, $i % $j);
				}
			} else {
				array_push($stack, $item);
			}
		}
		return $stack[0];
	}

	function mathexp_to_rpn($mathexp) {
		$i = 0;
		$final_stack = array();
		$operator_stack = array();

		while ($i < strlen($mathexp)) {
			$char = $mathexp{$i};
			if ($char >= '0' && $char <= '9') {
				$num = readnumber($mathexp, $i);
				array_push($final_stack, $num);
				$i += strlen($num); continue;
			}
			if (is_operator($char) || $char == '(') {
				array_push($operator_stack, $char);
				$i++; continue;
			}
			if ($char == ')') {
				// transfer operators to final stack
				do {
					$operator = array_pop($operator_stack);
					if ($operator == '(') break;
					array_push($final_stack, $operator);
				} while ($operator);
				$i++; continue;
			}
			$i++;
		}
		while ($oper = array_pop($operator_stack)) {
			array_push($final_stack, $oper);
		}
		return $final_stack;
	}

	function readnumber($string, $i) {
		$number = '';
		while ($string{$i} >= '0' && $string{$i} <= '9') {
			$number .= $string{$i};
			$i++;
		}
		return $number;
	}

	function is_operator($char) {
		static $operators = array('+', '-', '/', '*', '%');
		return in_array($char, $operators);
	}
?>
