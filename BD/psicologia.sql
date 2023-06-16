-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2023 a las 17:29:47
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `psicologia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_familiar`
--

CREATE TABLE `area_familiar` (
  `IdFamiliar` int(11) NOT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `NomPadre` varchar(30) NOT NULL,
  `NomMadre` varchar(30) NOT NULL,
  `CantHermanos` int(11) DEFAULT NULL,
  `CantHijos` int(11) DEFAULT NULL,
  `integracion_familiar` varchar(100) NOT NULL,
  `historial_martial` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `area_familiar`
--

INSERT INTO `area_familiar` (`IdFamiliar`, `id_paciente`, `NomPadre`, `NomMadre`, `CantHermanos`, `CantHijos`, `integracion_familiar`, `historial_martial`) VALUES
(6, 2, 'asdasd', 'adad', 2, 1, 'asdad', 'asdada'),
(7, 2, 'ad', 'ads', 2, 1, 'asda', 'adas'),
(8, 1, 'jorge', 'liliana', 2, 0, 'asdas', 'dasdasda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atencion_paciente`
--

CREATE TABLE `atencion_paciente` (
  `id` int(11) NOT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `id_enfermedad` int(11) DEFAULT NULL,
  `diagnostico` varchar(500) NOT NULL,
  `tratamiento` varchar(500) NOT NULL,
  `observacion` varchar(500) NOT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `atencion_paciente`
--

INSERT INTO `atencion_paciente` (`id`, `id_paciente`, `id_enfermedad`, `diagnostico`, `tratamiento`, `observacion`, `fecha_registro`) VALUES
(9, 3, 2, 'yaya', 'nono', 'sisi', '2023-05-31 10:01:45'),
(10, 3, 2, 'ok', 'cambio', 'nuevo', '2023-05-31 10:02:17'),
(12, 1, 1, 'asda', 'asd', 'asd', '2023-06-01 20:54:51'),
(16, 3, 2, 'asd', 'asd', 'ad', '2023-06-01 20:57:12'),
(17, 1, 2, 'asda', 'dasdasda', 'dasdad', '2023-06-05 20:17:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id_cita` int(11) NOT NULL,
  `fecha_registro` date DEFAULT NULL,
  `fecha_cita_Inicio` datetime DEFAULT NULL,
  `fecha_cita_Fin` datetime DEFAULT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `d_nombre` varchar(10) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`id_cita`, `fecha_registro`, `fecha_cita_Inicio`, `fecha_cita_Fin`, `id_paciente`, `d_nombre`) VALUES
(24, '2023-06-06', '2023-06-05 00:00:00', '2023-06-05 03:21:00', 3, 'luis'),
(26, '2023-06-06', '2023-06-08 22:28:00', '2023-06-08 23:28:00', 10, 'luis'),
(27, '2023-06-06', '2023-06-06 12:17:00', '2023-06-06 13:17:00', 2, 'jose');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermedad`
--

CREATE TABLE `enfermedad` (
  `id_enfermedad` int(11) NOT NULL,
  `NombreEmfermedad` varchar(59) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `enfermedad`
--

INSERT INTO `enfermedad` (`id_enfermedad`, `NombreEmfermedad`) VALUES
(1, 'Gripe'),
(2, 'Resfriado común'),
(3, 'Hipertensión'),
(4, 'Diabetes'),
(5, 'Asma'),
(6, 'Artritis'),
(7, 'Depresión'),
(8, 'Cáncer'),
(9, 'Anemia'),
(10, 'Migraña');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id_paciente` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `ap_paterno` varchar(30) NOT NULL,
  `ap_materno` varchar(30) NOT NULL,
  `dni` char(8) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `edad` char(3) NOT NULL,
  `grado_instruccion` varchar(50) NOT NULL,
  `ocuapacion` varchar(50) NOT NULL,
  `EstadoCivil` varchar(50) NOT NULL,
  `genero` varchar(50) NOT NULL,
  `telefono` char(9) NOT NULL,
  `Email` varchar(80) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `Antecedentes` varchar(50) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id_paciente`, `nombre`, `ap_paterno`, `ap_materno`, `dni`, `fecha_nacimiento`, `edad`, `grado_instruccion`, `ocuapacion`, `EstadoCivil`, `genero`, `telefono`, `Email`, `direccion`, `Antecedentes`) VALUES
(1, 'Juan', 'Gómez', 'López', '12345678', '1990-05-15', '33', 'Licenciatura', 'Ingeniero', 'Soltero/a', 'Masculino', '987654321', 'juan@example.com', 'Calle Principal 123', 'Ninguno'),
(2, 'María', 'Pérez', 'García', '87654321', '1985-10-20', '38', 'Doctorado', 'Médica', 'Casado/a', 'Femenino', '654321987', 'maria@example.com', 'Avenida Central 456', 'Ninguno'),
(3, 'Pedro', 'Rodríguez', 'Vargas', '23456789', '1995-02-12', '28', 'Bachillerato', 'Abogado', 'Soltero/a', 'Masculino', '789456123', 'pedro@example.com', 'Plaza Mayor 789', 'Ninguno'),
(4, 'Ana', 'López', 'Torres', '98765432', '1982-09-03', '41', 'Licenciatura', 'Contadora', 'Casado/a', 'Femenino', '321654987', 'ana@example.com', 'Calle Secundaria 321', 'Hipertensión'),
(5, 'Luis', 'Hernández', 'Gómez', '34567890', '1998-07-25', '23', 'Bachillerato', 'Estudiante', 'Soltero/a', 'Masculino', '456789012', 'luis@example.com', 'Avenida Principal 789', 'Ninguno'),
(6, 'Laura', 'García', 'López', '87654321', '1993-04-18', '28', 'Licenciatura', 'Ingeniera', 'Soltero/a', 'Femenino', '987012345', 'laura@example.com', 'Calle Principal 567', 'Ninguno'),
(7, 'Carlos', 'Fernández', 'Martínez', '54321678', '1991-01-05', '30', 'Bachillerato', 'Administrador', 'Soltero/a', 'Masculino', '012345678', 'carlos@example.com', 'Plaza Central 901', 'Ninguno'),
(8, 'Sofía', 'Vargas', 'Pérez', '87654321', '1980-12-28', '43', 'Licenciatura', 'Profesora', 'Casado/a', 'Femenino', '765432109', 'sofia@example.com', 'Avenida Principal 234', 'Diabetes'),
(9, 'Miguel', 'Torres', 'Hernández', '56789012', '1997-08-10', '26', 'Bachillerato', 'Estudiante', 'Soltero/a', 'Masculino', '890123456', 'miguel@example.com', 'Calle Secundaria 678', 'Ninguno'),
(10, 'Ana', 'Gómez', 'Rodríguez', '12345678', '1994-03-07', '29', 'Licenciatura', 'Ingeniera', 'Soltero/a', 'Femenino', '567890123', 'ana@example.com', 'Avenida Central 789', 'Ninguno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `fecha_creacion`, `fecha_modificacion`, `password`) VALUES
(1, '', 'jorge', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '123456');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area_familiar`
--
ALTER TABLE `area_familiar`
  ADD PRIMARY KEY (`IdFamiliar`),
  ADD KEY `fk_paciente_familiar` (`id_paciente`);

--
-- Indices de la tabla `atencion_paciente`
--
ALTER TABLE `atencion_paciente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_paciente` (`id_paciente`),
  ADD KEY `fk_enfermedad` (`id_enfermedad`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `fk_paciente_cita` (`id_paciente`);

--
-- Indices de la tabla `enfermedad`
--
ALTER TABLE `enfermedad`
  ADD PRIMARY KEY (`id_enfermedad`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id_paciente`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area_familiar`
--
ALTER TABLE `area_familiar`
  MODIFY `IdFamiliar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `atencion_paciente`
--
ALTER TABLE `atencion_paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `enfermedad`
--
ALTER TABLE `enfermedad`
  MODIFY `id_enfermedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `area_familiar`
--
ALTER TABLE `area_familiar`
  ADD CONSTRAINT `fk_paciente_familiar` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE;

--
-- Filtros para la tabla `atencion_paciente`
--
ALTER TABLE `atencion_paciente`
  ADD CONSTRAINT `fk_enfermedad` FOREIGN KEY (`id_enfermedad`) REFERENCES `enfermedad` (`id_enfermedad`),
  ADD CONSTRAINT `fk_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `fk_paciente_cita` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE;
COMMIT;

-- Filtros para la tabla `cita`
ALTER TABLE `cita`
  ADD CONSTRAINT `fk_cita_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;


-- Filtros para la tabla `paciente`
ALTER TABLE `paciente`
  ADD CONSTRAINT `fk_paciente_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
