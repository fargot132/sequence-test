Sample PHP/Symfony code calculating largest number of the sequence of numbers. 
Where a(i) is given, i = 0, 1, 2, ..., defined by conditions:
a(0) = 0
a(1) = 1
a(2i) = a(i)
a(2i+1) = a(i) + a(i+1)

Sequence is a(0), a(1), ..., a(n)
n range is (1<= n =< 99 999)
Max number of cases is 10.

Data input from form, stdin or as command parameter.

cat tests/test_file.txt | php bin/console app:sequence-calc
php bin/console app:sequence-calc tests/test_file.txt
