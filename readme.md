# Corbomite Migrations

Part of BuzzingPixel's Corbomite project.

Provides a light wrapper around [Phinx](https://phinx.org/) to make it available to Corbomite.

## Usage

Please note `APP_BASE_PATH` must be defined as a constant.

Once you've composer required into your Corbomite project, there will be some new commands available on the command line.

### `migrate/create-sample-config`

Creates a `phinx.php` config file with sample values at the root of your project.

### `migrate/create`

Creates a migration file in the directory specified in your `phinx.php` config file.

### `migrate/status`

Shows the status of migrations.

### `migrate/up`

Runs any migrations that have not yet been run.

### `migrate/down`

Rolls back the previous migration or to the specified target.

## License

Copyright 2019 BuzzingPixel, LLC

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at [http://www.apache.org/licenses/LICENSE-2.0](http://www.apache.org/licenses/LICENSE-2.0).

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
