$ErrorActionPreference = 'Stop'
$phpCommand = Get-Command php -ErrorAction SilentlyContinue
$phpExecutable = $phpCommand.Source
if (-not $phpExecutable) {
	$packageDirectory = Join-Path $env:LOCALAPPDATA 'Microsoft\WinGet\Packages'
	$phpExecutable = Get-ChildItem $packageDirectory -Directory -Filter 'PHP.PHP.*' -ErrorAction SilentlyContinue |
		ForEach-Object { Join-Path $_.FullName 'php.exe' } |
		Where-Object { Test-Path $_ } |
		Select-Object -First 1
}
if (-not $phpExecutable) {
	throw 'PHP was not found. Install PHP 8.2 or newer, then run this script again.'
}
$extensionDirectory = Join-Path (Split-Path $phpExecutable) 'ext'
$loadedExtensions = & $phpExecutable -m
$requiredExtensions = @('pdo_sqlite', 'sqlite3')
$missingExtensions = @($requiredExtensions | Where-Object { $loadedExtensions -notcontains $_ })
$phpArguments = @()

if ($missingExtensions.Count -gt 0) {
	$phpArguments += @('-d', "extension_dir=$extensionDirectory")
	foreach ($extension in $missingExtensions) {
		$extensionFile = Join-Path $extensionDirectory "php_$extension.dll"
		if (-not (Test-Path $extensionFile)) {
			throw "Required PHP extension is unavailable: $extension"
		}
		$phpArguments += @('-d', "extension=$extension")
	}
}

Set-Location $PSScriptRoot
& $phpExecutable @phpArguments -S 127.0.0.1:8000 -t public public/index.php