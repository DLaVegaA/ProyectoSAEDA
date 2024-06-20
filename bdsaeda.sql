-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-01-2024 a las 06:03:05
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: sistema
--

/* CREATE DATABASE IF NOT EXISTS `bdSAEDA` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bdformulario`; */

CREATE SCHEMA IF NOT EXISTS `bdsaeda` DEFAULT CHARACTER SET utf8 ;
USE `bdsaeda` ;

--
-- Estructura de tabla admin
--

CREATE TABLE `administrador` (
    `idAdmin` INT  AUTO_INCREMENT PRIMARY KEY,
    `usuario` VARCHAR(50) NOT NULL,
    `contraseña` VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `administrador` (`usuario`, `contraseña`) 
VALUES ('admin', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla alumno
--

CREATE TABLE `alumno` (
  `NoBoleta` varchar(10) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `ApellidoPaterno` varchar(50) DEFAULT NULL,
  `ApellidoMaterno` varchar(50) DEFAULT NULL,
  `CURP` varchar(18) DEFAULT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `Genero` varchar(20) DEFAULT NULL,
  `Discapacidad` varchar(100) DEFAULT NULL,
  `Calle` varchar(100) DEFAULT NULL,
  `NumeroC` varchar(10) DEFAULT NULL,
  `EntidadFederativa` varchar(50) DEFAULT NULL,
  `MunicipioAlcaldia` varchar(50) DEFAULT NULL,
  `CodigoPostal` int(5) DEFAULT NULL,
  `Telefono` VARCHAR(20) DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `EscuelaProcedencia` varchar(100) DEFAULT NULL,
  `Promedio` float DEFAULT NULL,
  `ESCOM_Opcion` varchar(20) DEFAULT NULL,
  `idSalon` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla alumno
--

/* INSERT INTO `alumno` (`NoBoleta`, `Nombre`, `ApellidoPaterno`, `ApellidoMaterno`, `CURP`, `FechaNacimiento`, `Genero`, `Discapacidad`, `Calle`, `NumeroC`, `EntidadFederativa`, `MunicipioAlcaldia`, `CodigoPostal`, `Telefono`, `Correo`, `EscuelaProcedencia`, `Promedio`, `ESCOM_Opcion`, `idSalon`) 
VALUES
('2022630001', 'Juan', 'Pérez', 'González', 'PERJ930101HDFLRN05', '2003-01-01', 'Masculino', 'Ninguna', 'Av. Insurgentes Sur', '1234', 'Ciudad de México', 'Benito Juárez', '03810', '5551234567', 'juanP@alumno.ipn.mx', 'CECyT 1 González Vázquez Vega', 8.5, 'Primer opción', 'Laboratorio de sistemas I'),
('2022630002', 'María', 'García', 'López', 'GALM950202MSPRRN09', '2002-02-02', 'Femenino', 'Ninguna', 'Calle Reforma', '567', 'Nuevo León', 'Monterrey', '64000', '8187654321', 'margarc@alumnoguinda.ipn.mx', 'CECyT 2 Miguel Bernard', 9.2, 'Segunda opción', 'Laboratorio de sistemas I'),
('2022630003', 'Luis', 'Hernández', 'Martínez', 'HEMA980303MTSRRN03', '1998-03-03', 'Masculino', 'Ninguna', 'Calle Hidalgo', '890', 'Jalisco', 'Guadalajara', '44100', '3339876543', 'luishdz@alumno.ipn.com', 'CECyT 5 Benito Juárez García', 8.9, 'Tercer opción', 'Laboratorio de sistemas I'),
('2022630004', 'Ana', 'Rodríguez', 'Sánchez', 'ROSA970404MSMRRN08', '2001-04-04', 'Femenino', 'Discapacidad auditiva', 'Av. Juárez', '101', 'Puebla', 'Puebla', '72000', '2225554444', 'annna@alumnoguinda.mx.com', 'Preparatoria 2 de octubre', 8, 'Primer opción', 'Laboratorio de sistemas I'),
('2022630005', 'Pedro', 'López', 'Díaz', 'LODP960505HGRRRN07', '1999-05-05', 'Masculino', 'Discapacidad motriz usuaria de silla de ruedas', 'Av. Revolución', '2468', 'Baja California', 'Tijuana', '22000', '6643332222', 'pedrolopz@alumno.ipn.com', 'CECyT 15 Diódoro Antúnez Echegaray', 9.5, 'Segunda opción', 'Laboratorio de sistemas I'); */

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla salon
--

CREATE TABLE `salon` (
  `idSalon` varchar(35) NOT NULL,
  `numeroSalon` int(4) NOT NULL,
  `capacidadMAX` int(2) DEFAULT NULL,
  `alumnosRegistrados` int(2) DEFAULT NULL,
  `idHorario` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla salon
--

INSERT INTO `salon` (`idSalon`, `numeroSalon`, `capacidadMAX`, `alumnosRegistrados`, `idHorario`) VALUES
('Laboratorio de sistemas I', 2104, 30, 5,'horario1A'),
('Laboratorio de sistemas II', 2105, 30, 0,'horario1A'),
('Laboratorio de sistemas III', 2106, 30, 0,'horario1A'),
('Laboratorio de sistemas IV', 2107, 30, 0,'horario1A'),
('Laboratorio de programación I', 1105, 30, 0,'horario1A'),
('Laboratorio de programación II', 1106, 30, 0,'horario1A'),
('Laboratorio de programación III', 1107, 30, 0,'horario1B'),
('Laboratorio de redes', 1104, 30, 0,'horario1B'),
('Laboratorio de IA I', 4012, 30, 0,'horario1B'),
('Laboratorio de IA II', 4013, 30, 0,'horario1B'),
('Laboratorio de CD I', 3012, 30, 0,'horario1B'),
('Laboratorio de CD II', 3013, 30, 0,'horario1B');

--
-- Estructura de tabla para la tabla horario
--

CREATE TABLE `horario` (
  `idHorario` varchar(10) NOT NULL,
  `horario` varchar(30) DEFAULT NULL,
  `dia` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- volcado de datos para la tabla horario
--

INSERT INTO `horario` (`idHorario`, `horario`, `dia`) VALUES
('horario1A', 'Viernes 10:00-11:30', '2022-02-02'),
('horario1B', 'Viernes 14:00-15:30', '2022-02-02');


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla alumno
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`NoBoleta`),
  ADD KEY `alumno_Salon` (`idSalon`);

--
-- Indices de la tabla salon
--
ALTER TABLE `salon`
  ADD PRIMARY KEY (`idSalon`),
  ADD KEY `salon_horario` (`idHorario`);

--
-- Indices de la tabla horario
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`idHorario`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla alumno
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_Salon` FOREIGN KEY (`idSalon`) REFERENCES `salon` (`idSalon`) ON DELETE CASCADE;
COMMIT;

--
-- Filtros para la tabla salon
--
ALTER TABLE `salon`
  ADD CONSTRAINT `salon_horario` FOREIGN KEY (`idHorario`) REFERENCES `horario` (`idHorario`) ON DELETE CASCADE;
COMMIT;

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerPrimerSalon` (OUT `salonId` VARCHAR(35))   BEGIN
    -- Inicializar la variable con un valor predeterminado (puedes ajustar según tus necesidades)
    SET salonId = NULL;

    -- Obtener el primer salón que cumple con la condición
    SELECT salon.idSalon INTO salonId
    FROM salon
    WHERE salon.alumnosregistrados < 30
    ORDER BY salon.idSalon
    LIMIT 1;

    -- Verificar si se obtuvo un idSalon válido
    IF salonId IS NOT NULL THEN
        -- Incrementar en 1 el campo alumnosRegistrados para el salón obtenido
        UPDATE salon
        SET alumnosRegistrados = alumnosRegistrados + 1
        WHERE idSalon = salonId;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerNoSalon` (IN `salonId` VARCHAR(35), OUT `salonNo` int(4))   BEGIN
    SET salonNo = NULL;

    SELECT salon.numeroSalon INTO salonNo
    FROM salon
    WHERE salon.idSalon = salonId
    LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObteneridHorario` (IN `salonId` VARCHAR(35), OUT `horarioId` VARCHAR(10))   BEGIN
    SET horarioId = NULL;

    SELECT salon.idHorario INTO horarioId
    FROM salon
    WHERE salon.idSalon = salonId
    LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerHorario` (IN `horarioId` VARCHAR(10), OUT `Horario` VARCHAR(30))   BEGIN
    SET Horario = NULL;

    SELECT horario.horario INTO Horario
    FROM horario
    WHERE horario.idHorario = horarioId
    LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerDia` (IN `horarioId` VARCHAR(10), OUT `Dia` VARCHAR(10))   BEGIN
    SET Dia = NULL;

    SELECT DATE_FORMAT(horario.dia, '%Y-%m-%d') INTO Dia
    FROM horario
    WHERE horario.idHorario = horarioId
    LIMIT 1;
END$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
