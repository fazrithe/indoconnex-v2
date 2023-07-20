ALTER TABLE apps_operator_privilege
MODIFY COLUMN privilege VARCHAR(4);

UPDATE apps_operator_privilege
SET privilege = '0000'
WHERE privilege = '0';