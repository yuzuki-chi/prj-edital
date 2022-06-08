-- 1. Administer account (Required)

CREATE USER 'yuzukichi'@'%' identified by 'yuzukichi';
GRANT ALL ON *.* to 'yuzukichi'@'%';

-- 2. Add here to Dedicated Account of wp

-- --TEMPLATE------------------------------------------
CREATE DATABASE IF NOT EXISTS edital_general;
-- CREATE USER '<USER NAME>'@'%' identified by '<USER PASSWORD>';
-- GRANT ALL ON <DATABASE NAME>.* to '<USER NAME>'@'%';
-- ----------------------------------------------------