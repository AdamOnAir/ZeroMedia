# ZeroMedia
ZeroMedia is a media Server for my Homelab, based on a PI Zero.

## Using
You can use it f you want (respecting the [LICENSE](LICENSE)). If you want to  reconfigure it, see the [Compile section](#config)

## Compile
```bash
git clone https://github.com/FBDev64/ZeroMedia.git
cd ZeroMedia/src

# Launch Server
php -S $(hostname -I | awk '{print $1}'):8080
```
Then go to the Raspberry Pi's IP on port 8080 in your favorite browser, alias The Grat Firefox.

## Config
To reconfigure the paths, just edit the [index.php](src/index.php) file. You will find code the following code :
```php
$extensions = array(
    'mp4' => 'videos/',
    'mov' => 'videos/',
    'avi' => 'videos/',
    'jpg' => 'images/',
    'png' => 'images/',
    'gif' => 'images/',
    // Other extensions    
);

$uploadDir = 'uploads/';
```
Edit the `$uploadDir` to another disk or anything, and maybe the `$extensions` to your needs.

