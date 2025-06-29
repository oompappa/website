<?php
echo password_hash("password", PASSWORD_DEFAULT);
?>


$2y$10$ETR7Jl/l.0Uxx64dtqsGc.PG399yiz5KYlRuD4L62tMHqUZUQtvym

INSERT INTO users (f_name, l_name, username, email, password, user_type)
VALUES (
'Admin',
'One',
'admin1',
'admin1@gmail.com',
'$2y$10$ETR7Jl/l.0Uxx64dtqsGc.PG399yiz5KYlRuD4L62tMHqUZUQtvym',
'admin'
);