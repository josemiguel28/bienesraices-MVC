create table if not exists usuarios
(
    idusuarios int auto_increment
        primary key,
    usuario    varchar(45) not null,
    password   varchar(60) not null
);

create table if not exists vendedores
(
    id       int auto_increment
        primary key,
    nombre   varchar(30) null,
    apellido varchar(45) null,
    telefono varchar(10) null
);

create table if not exists propiedades
(
    id              int auto_increment
        primary key,
    titulo          varchar(45)    null,
    precio          decimal(10, 2) null,
    imagen          varchar(200)   null,
    descripcion     longtext       null,
    habitaciones    int            null,
    wc              int            null,
    estacionamiento int            null,
    creado          date           null,
    vendedorId      int            not null,
    vendida         int default 0  null,
    constraint fk_propiedades_vendedores
        foreign key (vendedorId) references vendedores (id)
);

create index fk_propiedades_vendedores_idx
    on propiedades (vendedorId);


