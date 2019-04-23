CREATE TABLE `contents` (
    id BIGINT UNIQUE AUTO_INCREMENT,
    content MEDIUMTEXT NOT NULL,
    author VARCHAR(255),
    creation_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    editted_date  DATETIME ON UPDATE CURRENT_TIMESTAMP,
    edit_password CHAR(8) UNIQUE # maybe for searching
);

# tests
INSERT into `contents` (
        content, author, edit_password
    ) VALUES (
        "heres, the MOTHERFUCKING, tea", "danny", "12345678"
    );

SELECT * FROM `contents`;