declare -A my_array2
my_array2[credentiales]='{"login":"testUser","digest":"c755e6c97e460c3a60efbe83ca6ebc0a81e45105","timestamp":1563959214}'


WSCall=$(curl --silent --verbose --header "Content-Type: text/soap+xml;charset=UTF-8" --header "SOAPAction: 'http://sap.com/xi/WebService/soap1.1'" --data '<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:hellowsdl"><soapenv:Header/><soapenv:Body><connection><credentiales>{"login":"testUser","digest":"c755e6c97e460c3a60efbe83ca6ebc0a81e45105","timestamp":1563959214}</credentiales></connection></soapenv:Body></soapenv:Envelope>' -X POST 'http://51.38.234.197/zuuluAPIBaseMS/web/app_dev.php')


echo $WSCall
