create database CMS;
use CMS;

create table cms_user(
	id INT PRIMARY KEY AUTO_INCREMENT,
    first_name varchar(50) not null,
    last_name varchar(50) not null,
    email varchar(50) not null,
    password varchar(50) not null,
    type int(11) not null,
    deleted int(11) not null default 0 
);

create table cms_category(
	id int(11) PRIMARY KEY AUTO_INCREMENT,
    name varchar(100) not null
);

CREATE TABLE `cms_posts` (
  id INT PRIMARY KEY AUTO_INCREMENT,
  title TEXT NOT NULL,
  message TEXT NOT NULL,
  category_id INT,
  userid INT,
  status ENUM('published', 'draft', 'archived') NOT NULL DEFAULT 'published',
  created DATETIME NOT NULL,
  updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (category_id) REFERENCES cms_category (id),
  FOREIGN KEY (userid) REFERENCES cms_user (id)
);
