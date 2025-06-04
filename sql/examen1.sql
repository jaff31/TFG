
drop database if exists examen1;
create database if not exists examen1;

use examen1;

create table tareas(
 id int Primary Key auto_increment,
 nombre varchar(50) NOT null,
 descripcion varchar(200) NOT null,
 fecha_creacion date  NOT NULL
 );
 
 insert into tareas(nombre,descripcion,fecha_creacion) values('Revisar documentación','',curdate());
 insert into tareas(nombre,descripcion,fecha_creacion) values('Preparar presentacion','',date_add(curdate(),Interval 1 day));
 insert into tareas(nombre,descripcion,fecha_creacion) values('Corregir errores','',date_add(curdate(),Interval 2 day));

create table alumno(
 id int Primary Key auto_increment,
 nombre varchar(50) NOT null,
 email varchar(50) NOT null,
 fecha_creacion date  NOT NULL
 );
 Select id from tareas where nombre = 'revisar documentacion';
 select curdate();
insert into alumno(nombre,email,fecha_creacion) values('Juan Pérez','juan@example.com',curdate());
 insert into alumno(nombre,email,fecha_creacion) values('María Gómez','maria@example.com',date_add(curdate(),Interval 1 day));
 insert into alumno(nombre,email,fecha_creacion) values('Carlos Ruiz','carlos@example.com',date_add(curdate(),Interval 2 day));
 
create table registros(
 id int Primary Key auto_increment,
 id_tarea int ,
 id_alumno int ,
 progreso decimal(5,2),
 descripcion varchar(200),
 fecha_creacion date  NOT NULL,
 Foreign key(id_tarea) references tareas(id),
 Foreign key(id_alumno) references alumno(id)
 );
 
 create table usuarios(
 id int Primary key auto_increment,
 email varchar(50) UNIQUE,
 clave varchar(30),
 admin boolean default false
 );

insert into usuarios (email,clave,admin) values('a@gmail.com','1',true);
insert into usuarios (email,clave,admin) values('b@gmail.com','2',false);

 insert into registros(id_Tarea,id_Alumno,progreso,descripcion,fecha_creacion) values(1,1,10,'',curdate());
 insert into registros(id_Tarea,id_Alumno,progreso,descripcion,fecha_creacion) values(2,2,60,'',curdate());
 insert into registros(id_Tarea,id_Alumno,progreso,descripcion,fecha_creacion) values(3,3,50,'',date_add(curdate(),Interval 2 day));
 Select id,(Select nombre from tareas t where r.id_Tarea = t.id) as 'nombreTarea',(Select nombre from alumno a where r.id_Alumno = a.id) as 'nombreAlumno',progreso,fecha_creacion from registros r;


select * from tareas;	
select * from alumno;
select * from registros;	
select * from usuarios;