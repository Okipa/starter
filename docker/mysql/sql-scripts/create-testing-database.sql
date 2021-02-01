-- Grant PROCESS privileges to MySQL user to give it right to execute the `artisan schema:dump` method.
-- Todo: customize MySQL user according to .env file.
GRANT PROCESS, SELECT ON *.* to 'starter'@'%';

-- Create `testing` user with `testing` additional database.
CREATE DATABASE testing CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'testing'@'%' IDENTIFIED BY 'secret';
GRANT ALL PRIVILEGES ON * . * TO 'testing'@'%';

FLUSH PRIVILEGES;
