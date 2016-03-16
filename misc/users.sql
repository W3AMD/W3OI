create table users (
	username varchar(20),
	password varchar(255),
	admin BOOL,
	announcements BOOL,
	membership BOOL,
	newsletter BOOL,
	pictures Bool,
	primary key (username)
);

insert into users
values
( 'test', sha1('test') ),
( 'admin', sha1('admin') );

create table user_priviliges (
	username varchar(20),
	admin BOOL,
	announcements BOOL,
	membership BOOL,
	newsletter BOOL,
	pictures Bool,
	primary key (username)
);

insert into user_priviliges
values
( 'test', 0, 1, 0, 0, 0 ),
( 'admin', 1, 0, 0, 0, 0 );

