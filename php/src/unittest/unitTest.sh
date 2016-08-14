#!/bin/sh

cd /var/www/html/unittest

echo "# ******************************************************************* #"
echo "          Testing the PHP Class loginClass       " 
echo "# ******************************************************************* #"

php ./userClassTest.php

echo "# ******************************************************************* #"
echo "          Testing the PHP Class chatClass       "
echo "# ******************************************************************* #"


php ./chatClassTest.php

