Sample PHP/Symfony code calculating largest number of the sequence of numbers. <br />
Where a(i) is given, i = 0, 1, 2, ..., defined by conditions:<br />
a(0) = 0<br />
a(1) = 1<br />
a(2i) = a(i)<br />
a(2i+1) = a(i) + a(i+1)<br />

Sequence is a(0), a(1), ..., a(n)<br />
n range is (1<= n =< 99 999)<br />
Max number of cases is 10.<br />

Data input from form, stdin or as command parameter.<br />

cat tests/test_file.txt | php bin/console app:sequence-calc<br />
php bin/console app:sequence-calc tests/test_file.txt
