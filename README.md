## PHP Client for Ploteus Turkey Integration Pool

##$ Example usage of uploading learning opportunities:

```php
$loXmlFile = fopen("lo_full_sample.xml", "r");
$loContent =  fread($loXmlFile,filesize("lo_full_sample.xml"));
fclose($loXmlFile);

include("PloteusTRClient.php");
$ploteusClient = new PloteusTRClient("USER_NAME", "PASSWORD");
$resp = $ploteusClient->uploadLearningOpportunitiesXml($loContent);

```
