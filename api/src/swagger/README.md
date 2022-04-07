# How it works ?

### To generate openapi.yaml (essential for Swagger.io)
* Make sur one of Controller is well documented (and Entity)
=>for example "PlatController.php"


* Generate openapi.yaml with this command:
```bash
cd api
```
```bash
vendor/bin/openapi src -o src/swagger/openapi.yaml
```
