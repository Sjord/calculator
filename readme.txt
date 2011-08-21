Functions which parse a simple mathematical expression and calculate
the result.

The function mathexp_to_rpn() converts a mathematical expression in 
infix notation, like "3 + 2" to an expression in reverse polish
notation (RPN): "3 2 +". This is easier to calculate, which is done
by the function calculate_rpn(). Operator precedence and parenthesis
is taken into account. There is no checking whether the input is
a valid expression. Dividing is not very precise.

This file is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.

You may use this file according to one of the following licenses:
- GNU General Public License, version 2 or higher
<http://www.gnu.org/licenses/gpl.html>
- GNU Lesser General Public License, version 2.1 or higher
<http://www.gnu.org/licenses/lgpl.html>
- Mozilla Public License, version 1.1 or higher
<http://www.mozilla.org/MPL/>

You are not required to accept any of the above licenses, since you have 
not signed any of them. However, nothing else grants you permission to 
modify or distribute this file or its derivative works. These actions 
are prohibited by law if you do not accept any of the above licenses.

