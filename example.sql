create table sys_music
(
	id int auto_increment key,
	title varchar(255) not null comment '歌曲名称',
	artist varchar(255) null comment '歌手',
	cover varchar(255) not null comment '封面',
	src varchar(255) not null comment '歌曲保存位置',
	create_time int not null comment '创建时间',
	update_time int not null comment '更新时间',
	delete_time int comment '删除时间'
);

create unique index sys_music_id_uindex
	on sys_music (id);

alter table sys_music
	add constraint sys_music_pk
		primary key (id);

