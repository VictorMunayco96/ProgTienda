INSERT INTO `tienda` (`IdTienda`, `RazonSocial`, `Ruc`, `Estado`) VALUES (NULL, 'Calicel', '12345678912', '1');

INSERT INTO `sucursal` (`IdSucursal`, `IdTienda`, `Direccion`, `Departamento`, `Provincia`, `Estado`) VALUES (NULL, '1', 'Ica', 'Ica', 'Ica', '1');

INSERT INTO `personal` (`IdPersonal`, `Nombre`, `Apellido`, `FecNac`, `Estado`, `TipoDocumento`, `NumDocumento`, `Area`, `Cargo`, `IdSucursal`) VALUES (NULL, 'Administrador', 'Administrador', '1996-01-01', '1', 'DNI', '70605597', 'ADMINISTRACION', 'ADMINISTRADOR', '1');

INSERT INTO `usuario` (`IdUsuario`, `IdPersonal`, `Usuario`, `Contrasena`, `TipoUsuario`, `Estado`, `IdSucursal`) VALUES (NULL, '1', 'ADMIN', 'ADMIN', 'ADMINISTRADOR', '1', '1');

INSERT INTO `permiso` (`IdPermiso`, `Nombre`, `Estado`) VALUES (NULL, 'Escritorio', '1'), (NULL, 'Producto', '1'), (NULL, 'Almacen', '1'), (NULL, 'Almacen Sucursal', '1'), (NULL, 'Compras', '1'), (NULL, 'Ventas', '1'), (NULL, 'Datos Tienda', '1'), (NULL, 'Acceso', '1'), (NULL, 'Consulta Compras', '1'), (NULL, 'Consulta Ventas', '1');


INSERT INTO `detallepermiso` (`IdDetallePermiso`, `IdPermiso`, `IdUsuario`) VALUES (NULL, '1', '1'), (NULL, '2', '1'), (NULL, '3', '1'), (NULL, '4', '1'), (NULL, '5', '1'), (NULL, '6', '1'), (NULL, '7', '1'), (NULL, '8', '1'), (NULL, '9', '1'), (NULL, '10', '1');