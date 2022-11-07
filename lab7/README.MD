<!-- Part 1 -->
CREATE TABLE courses(
    PRIMARY KEY(CRN),
    crn INT(11),
    prefix VARCHAR(4) NOT NULL,
    number SMALLINT(4) NOT NULL,
    title VARCHAR(255) NOT NULL
);

CREATE TABLE students(
    PRIMARY KEY(RIN),
    RIN INT(9),
    RCSID CHAR(7),
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    alias VARCHAR(100) NOT NULL,
    phone INT(10)
);

<!-- Part 2 -->
<!-- 1 --> 
ALTER TABLE
    students
ADD
    street VARCHAR(255);

ALTER TABLE
    students
ADD
    city VARCHAR(255);

ALTER TABLE
    students
ADD
    state CHAR(2);

ALTER TABLE
    students
ADD
    zip CHAR(5);

<!-- 2 -->
ALTER TABLE
    courses
ADD
    section INT(4);

ALTER TABLE
    courses
ADD
    year INT(4);

<!-- 3 -->
CREATE TABLE grades(
    PRIMARY KEY(id),
    id INT NOT NULL AUTO_INCREMENT,
    crn INT(11),
    FOREIGN KEY(crn) REFERENCES courses(crn),
    RIN INT(9),
    FOREIGN KEY(RIN) REFERENCES students(RIN),
    grade INT(3) NOT NULL
);

<!-- 4 -->
INSERT INTO
    courses(
        crn,
        prefix,
        number,
        title,
        section,
        year
    )
VALUES
(
        79588,
        'ITWS',
        4500,
        'WEB SCIENCE SYSTEMS DEV',
        01,
        2023
    );

INSERT INTO
    courses(
        crn,
        prefix,
        number,
        title,
        section,
        year
    )
VALUES
(
        78486,
        'ITWS',
        4500,
        'WEB SCIENCE SYSTEMS DEV',
        02,
        2023
    );

INSERT INTO
    courses(
        crn,
        prefix,
        number,
        title,
        section,
        year
    )
VALUES
(
        57076,
        'ITWS',
        2110,
        'WEB SYSTEMS DEVELOPMENT',
        01,
        2022
    );

INSERT INTO
    courses(
        crn,
        prefix,
        number,
        title,
        section,
        year
    )
VALUES
(
        58346,
        'ITWS',
        2110,
        'WEB SYSTEMS DEVELOPMENT',
        02,
        2022
    );

<!-- 5 -->
INSERT INTO
    students(
        RIN,
        RCSID,
        firstname,
        lastname,
        alias,
        phone,
        street,
        city,
        state,
        zip
    )
VALUES
(
        907490096,
        'howelc',
        'CIAN',
        'HOWELL',
        'Cian',
        2029182132,
        '472 2nd Street',
        'Troy',
        'NY',
        12180
    );

INSERT INTO
    students(
        RIN,
        RCSID,
        firstname,
        lastname,
        alias,
        phone,
        street,
        city,
        state,
        zip
    )
VALUES
(
        628448466,
        'roberf',
        'FRANK',
        'ROBERTS',
        'Frank',
        3269474572,
        '34 4th Street',
        'Troy',
        'NY',
        12180
    );

INSERT INTO
    students(
        RIN,
        RCSID,
        firstname,
        lastname,
        alias,
        phone,
        street,
        city,
        state,
        zip
    )
VALUES
(
        953220384,
        'brockg',
        'GARY',
        'BROCKNER',
        'Gary',
        2176942621,
        '56 5th Street',
        'Troy',
        'NY',
        12180
    );

INSERT INTO
    students(
        RIN,
        RCSID,
        firstname,
        lastname,
        alias,
        phone,
        street,
        city,
        state,
        zip
    )
VALUES
(
        284319388,
        'allenj',
        'JOSH',
        'ALLEN',
        'Josh',
        5056448428,
        '45 Congress Street',
        'Troy',
        'NY',
        12180
    );

<!-- 6 -->
INSERT INTO
    grades(crn, RIN, grade)
VALUES
(79588, 907490096, 100);

INSERT INTO
    grades(crn, RIN, grade)
VALUES
(78486, 907490096, 100);

INSERT INTO
    grades(crn, RIN, grade)
VALUES
(57076, 907490096, 100);

INSERT INTO
    grades(crn, RIN, grade)
VALUES
(58346, 907490096, 100);

INSERT INTO
    grades(crn, RIN, grade)
VALUES
(79588, 628448466, 82);

INSERT INTO
    grades(crn, RIN, grade)
VALUES
(78486, 628448466, 94);

INSERT INTO
    grades(crn, RIN, grade)
VALUES
(57076, 628448466, 76);

INSERT INTO
    grades(crn, RIN, grade)
VALUES
(58346, 628448466, 69);

INSERT INTO
    grades(crn, RIN, grade)
VALUES
(79588, 284319388, 79);

INSERT INTO
    grades(crn, RIN, grade)
VALUES
(78486, 284319388, 86);

<!-- 7 -->
SELECT
    *
FROM
    students
ORDER BY
    RIN;

SELECT
    *
FROM
    students
ORDER BY
    lastname;

SELECT
    *
FROM
    students
ORDER BY
    RCSID;

SELECT
    *
FROM
    students
ORDER BY
    firstname;

<!-- 8 -->
SELECT
    grades.RIN,
    students.firstname,
    students.lastname,
    students.street,
    students.city,
    students.state,
    students.zip
FROM
    grades,
    students
WHERE
    grades.grade > 89
    AND grades.RIN = students.RIN;

<!-- 9 -->
SELECT
    courses.crn,
    courses.prefix,
    courses.number,
    courses.title,
    courses.section,
    AVG(grades.grade) AS 'avg grade'
FROM
    courses,
    grades
WHERE
    grades.crn = courses.crn
GROUP BY
    crn;

<!-- 10 -->
SELECT
    courses.crn,
    courses.prefix,
    courses.number,
    courses.title,
    courses.section,
    COUNT(DISTINCT grades.RIN) AS 'num students in course'
FROM
    courses,
    grades
WHERE
    grades.crn = courses.crn
GROUP BY
    crn;