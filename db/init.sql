CREATE TABLE
    IF NOT EXISTS db_table (
        id INT PRIMARY KEY AUTO_INCREMENT,
        text VARCHAR(100) NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO
    db_table (text)
SELECT
    *
FROM
    (
        SELECT
            'azerty' AS text
        UNION ALL
        SELECT
            'abcdef'
        UNION ALL
        SELECT
            'xyz'
        UNION ALL
        SELECT
            '123456789'
    ) AS values_to_insert
WHERE
    NOT EXISTS (
        SELECT
            1
        FROM
            db_table
    );