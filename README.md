# ipa_signer
A PHP IPA Signer
## Config
1. Upload your IPA to file.ipa
2. Upload your p12 to file.p12
3. Upload your Mobileprovision to file.mobileprovision
4. Create a file at password.txt and save your password in there (if password exists)
## Sign
- Run index.php
- The output will save to file_signed.ipa
## Troubleshooting
If you are facing issues with the signer, add the following code to the top of the script:
```php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
```
All PHP errors will be outputted. If you are facing a permission error, make sure the file with the error and the script using that file are both owned by the same user.
