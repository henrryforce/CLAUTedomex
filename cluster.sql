-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 01-06-2022 a las 15:27:42
-- Versión del servidor: 8.0.27
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cluster`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `addUsersF`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addUsersF` (IN `usuario` VARCHAR(50), IN `pass` VARCHAR(100), IN `tipo` INT, IN `empresa` VARCHAR(50), IN `mail_cod` VARCHAR(6))  BEGIN
	Declare id_archivo int;
    Declare id_direccion int;
    Declare id_detalleE int;
    Declare id_empresa int;
    Declare id_user int;
	insert into archivos (Logo, Presentacion) values (null,null);
	set id_archivo = (select @@identity);
    insert into direccion  (Calle) values ('');
    set id_direccion = (select @@identity);
    insert into detalle_empresa (Descripcion,ID_archivo,ID_direccion) values ('',id_archivo,id_direccion);
    set id_detalleE =(select @@identity);
    insert into empresa (Empresa,ID_dtl_empresa) Values (empresa,id_detalleE);
    set id_empresa = (select @@identity);
    insert into usuario (usuario,contrasenia,Codigo_verificacion,ID_tipo_usr,ID_empresa) values (usuario,pass,mail_cod,tipo,id_empresa);
    set id_user = (select @@identity);
    INSERT INTO `certificacionescomprador`( `path`, `listaCerts`, `idcomprador`) VALUES (null,null,id_user);
    INSERT INTO `exportrequeridas`( `idcomprador`, `paisesExporta`) VALUES (id_user,null);
    select id_archivo,id_direccion,id_detalleE,id_empresa,id_user;
END$$

DROP PROCEDURE IF EXISTS `GetIDs`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetIDs` (IN `id_user` INT)  BEGIN
    set @id_empresa =(select ID_empresa from usuario where ID_usuario = id_user);
    set @id_dtl_empresa = (SELECT`ID_dtl_empresa` FROM `empresa` WHERE `ID_empresa` =@id_empresa);
    set @id_archivo = (SELECT `ID_archivo` FROM `detalle_empresa` WHERE `ID_dtl_empresa` =@id_dtl_empresa);
    set @id_direccion =(SELECT `ID_direccion` FROM `detalle_empresa` WHERE `ID_dtl_empresa` =@id_dtl_empresa);
    select @id_dtl_empresa as id_detalles,@id_archivo as id_archivo,@id_direccion as id_direccion;
END$$

DROP PROCEDURE IF EXISTS `updateUserInfo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateUserInfo` (IN `id_user` INT, IN `descrip` VARCHAR(300), IN `pagw` VARCHAR(50), IN `tel` VARCHAR(15), IN `Ext` INT, IN `ventasA` INT, IN `numEmp` INT, IN `calle` VARCHAR(50), IN `col` VARCHAR(50), IN `n_int` INT, IN `n_ext` INT, IN `cp` INT, IN `alcaldia` VARCHAR(50), IN `id_estado` INT, IN `logo` VARCHAR(50), IN `present` VARCHAR(50))  BEGIN
    set @id_empresa =(select ID_empresa from usuario where ID_usuario = id_user);
    set @id_dtl_empresa = (SELECT`ID_dtl_empresa` FROM `empresa` WHERE `ID_empresa` =@id_empresa);
    set @id_archivo = (SELECT `ID_archivo` FROM `detalle_empresa` WHERE `ID_dtl_empresa` =@id_dtl_empresa);
    set @id_direccion =(SELECT `ID_direccion` FROM `detalle_empresa` WHERE `ID_dtl_empresa` =@id_dtl_empresa);
    UPDATE `detalle_empresa` SET `Descripcion`=descrip,`Pagina_web`=pagw,`Tel`=tel,`Ext`=Ext,`Ventas_anuales`=ventasA,`Num_empleados`=numEmp WHERE `ID_dtl_empresa` = @id_dtl_empresa;
    UPDATE `direccion` SET `Calle`=calle,`N_Ext`=n_ext,`N_Int`=n_int,`Colonia`=col,`CP`=cp,`Alcaldia`=alcaldia,`ID_estado`=id_estado WHERE `ID_direccion` = @id_direccion;
    UPDATE `archivos` SET `Logo`=logo,`Presentacion`=present WHERE `ID_archivo`= @id_archivo;
    select @id_empresa,@id_dtl_empresa,@id_archivo,@id_direccion;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

DROP TABLE IF EXISTS `archivos`;
CREATE TABLE IF NOT EXISTS `archivos` (
  `ID_archivo` int NOT NULL AUTO_INCREMENT,
  `Logo` varchar(50) DEFAULT NULL,
  `Presentacion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_archivo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`ID_archivo`, `Logo`, `Presentacion`) VALUES
(1, 'archivosUpload/logos/ypise0t54d.jpeg', 'archivosUpload/PDF/5ymt6dsxn3.pdf'),
(2, 'archivosUpload/logos/ya7ge492l5.png', ''),
(3, 'archivosUpload/logos/n5qi31vetc.jpeg', 'archivosUpload/PDF/yu1al4c7te.pdf'),
(4, 'archivosUpload/logos/34gb2uzfma.png', 'archivosUpload/PDF/tfv20e1zb7.pdf'),
(5, 'archivosUpload/logos/q26m7ugejs.jpeg', 'archivosUpload/PDF/1uel6q0ckt.pdf'),
(6, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_estados`
--

DROP TABLE IF EXISTS `catalogo_estados`;
CREATE TABLE IF NOT EXISTS `catalogo_estados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `catalogo_estados`
--

INSERT INTO `catalogo_estados` (`id`, `nombre`) VALUES
(1, 'Aguascalientes'),
(2, 'Baja California'),
(3, 'Baja California Sur'),
(4, 'Campeche'),
(5, 'Chiapas'),
(6, 'Chihuahua'),
(7, 'Coahuila'),
(8, 'Colima'),
(9, 'Ciudad de México'),
(10, 'Durango'),
(11, 'Guanajuato'),
(12, 'Guerrero'),
(13, 'Hidalgo'),
(14, 'Jalisco'),
(15, 'México'),
(16, 'Michoacán'),
(17, 'Morelos'),
(18, 'Nayarit'),
(19, 'Nuevo León'),
(20, 'Oaxaca'),
(21, 'Puebla'),
(22, 'Querétaro'),
(23, 'Quintana Roo'),
(24, 'San Luis Potosí'),
(25, 'Sinaloa'),
(26, 'Sonora'),
(27, 'Tabasco'),
(28, 'Tamaulipas'),
(29, 'Tlaxcala'),
(30, 'Veracruz'),
(31, 'Yucatán'),
(32, 'Zacatecas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_indirectos`
--

DROP TABLE IF EXISTS `catalogo_indirectos`;
CREATE TABLE IF NOT EXISTS `catalogo_indirectos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `producto` varchar(700) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `producto` (`producto`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `catalogo_indirectos`
--

INSERT INTO `catalogo_indirectos` (`id`, `producto`) VALUES
(2, '		ACCOUNTS RECEIVABLE FACTORING WITH RECOURSE'),
(3, '		AIR CONDITIONER'),
(4, '		ALUMINUM SURFACE TREATMENT'),
(5, '		ANTI SPATTER'),
(6, '		CAD & DRAFTING'),
(7, '		CAE SIMULATION'),
(8, '		CALIBRATION TESTS'),
(9, '		CATERING'),
(10, '		CHEMICAL PRODUCTS'),
(11, '		CHILLER MAINTENANCE'),
(12, '		CLEANING EQUIPMENT'),
(13, '		COMPRESSOR MAINTENANCE'),
(14, '		COMPUTERS AND PRINTERS'),
(15, '		CONSTRUCTION OF WAREHOUSES AND BUILDINGS'),
(16, '		CONSTRUCTION STAFF SUPPLIER'),
(17, '		COOLANTS AND OILS FOR MACHINING'),
(18, '		CORROSION INHIBITOR'),
(19, '		CRAWLER CRANES'),
(20, '		CROSSBORDER TRANSPORTATION'),
(21, '		DESCALERS AND DEOXIDIZERS'),
(22, '		DESILTING'),
(23, '		DIE AND MOLD DEGREASER'),
(24, '		DIELECTRIC SOLVENTS'),
(25, '		DISC FILTERS (MEMBRANES).'),
(26, '		DISINFECTION WITH UV LIGHT LAMPS'),
(27, '		DRAINAGE OF WASTEWATER'),
(28, '		ECO MINICRANE'),
(29, '		ELECTRIC CRANES'),
(30, '		ELECTRICAL DESIGN'),
(31, '		ELECTRICAL MATERIALS'),
(32, '		EMC TESTS'),
(33, '		EQUIPMENT LEASING: FINANCE AND OPERATING LEASES'),
(34, '		FACTORING FOR SUPPLIERS'),
(35, '		FILTERS BAG NYLON POLYPROPYLENE ETC.'),
(36, '		FILTERS FOR COMPRESSED AND HYDRAULIC AIR'),
(37, '		FILTERS FOR INKS PAINT AND PHOSPHATIZATION.'),
(38, '		FILTERS FOR OILS FUELS SILICONES ADHESIVES ETC.'),
(39, '		FILTERS FOR SOLVENTS ACIDS OR ALKALINE.'),
(40, '		FILTERS FOR VENTING HYDROPHOBIC AND COALESCING.'),
(41, '		FINANCIAL PRODUCTS'),
(42, '		FULL TRUCK LOAD SERVICES'),
(43, '		GARDENING AND FUMIGATION'),
(44, '		GASES'),
(45, '		GENERAL REPAIRS'),
(46, '		GOVERNMENT AGENCY'),
(47, '		HARDWARE'),
(48, '		HYDRAULIC'),
(49, '		IMPORTS AND EXPORTS'),
(50, '		INDOOR CRANES'),
(51, '		INDUSTRIAL DETERGENTS'),
(52, '		INDUSTRIAL MARKERS'),
(53, '		INDUSTRIAL SCRAP'),
(54, '		INLAND TRANSPORTATION SOLUTIONS'),
(55, '		INSPECTION & REWORK'),
(56, '		LAB MATERIAL AND TESTING EQUIPMENT'),
(57, '		LESS THAT A TRUCK SERVICES'),
(58, '		LOGISTIC'),
(59, '		MACHINERY REPAIRS'),
(60, '		MACHINING WITH DRAWING'),
(61, '		MECHANICAL DESIGN'),
(62, '		MECHANICAL MATERIALS'),
(63, '		MEDIA PARTNERS PROVEEDOR AUTOMOTRIZ'),
(64, '		MINI CRANES'),
(65, '		MINI PICKER'),
(66, '		MOBILE CRANES'),
(67, '		OFFICE SUPPLIES'),
(68, '		PIPE LINE MAINTENANCE'),
(69, '		PLATFORM RENTAL'),
(70, '		PLUMBING MAINTENANCE'),
(71, '		POLISHING FILTERS FOR WATER'),
(72, '		PORTABLE TOILETS & PORTABLE WC'),
(73, '		PRODUCT OPTIMIZATION'),
(74, '		PROJECT MANAGEMENT'),
(75, '		RELEASE AGENT ALUMINUM INJECTION'),
(76, '		RELEASE AGENT FOR FOUNDRY AND FORGING STEEL AND ALUMINUM'),
(77, '		RELEASE AGENT FOR SAND MOLD'),
(78, '		RELEASE AGENT INJECTION PLASTIC AND POLYURETHANE'),
(79, '		REVERSE ENGINEERING'),
(80, '		REVERSE OSMOSIS'),
(81, '		SAFETY AND CARE OF THE ENVIRONMENT'),
(82, '		SAFETY EQUIPMENT'),
(83, '		SAFETY SHOES'),
(84, '		SANITARY AND INDUSTRIAL HOUSING CARDTRIGES'),
(85, '		SCRAP'),
(86, '		SINTERED STEEL AND STAINLESS STEEL MESH FILTERS.'),
(87, '		SOFTWARE DEVELOPMENT'),
(88, '		SORTING'),
(89, '		STAMPING AND FORMING LUBRICANTS'),
(90, '		STERILIZING CARTRIDGE FILTERS'),
(91, '		STORAGE'),
(92, '		SUPPLY CHAIN'),
(93, '		THIRD PARTY AUTOMOBILE LABORATORY'),
(94, '		TOOLING DESIGN'),
(95, '		TRANSPORTATION MANAGEMENT SYSTEM'),
(96, '		TRANSPORTATION OF PERSONNEL'),
(97, '		WASTE MANAGEMENT'),
(98, '		WATER PURIFICATION'),
(99, '		WORKING CAPITAL FINANCING'),
(111, 'ELECTRICAL TECHNICIAN\r\n'),
(116, 'fsdfds'),
(108, 'LOGISTICS TRANSPORTATION'),
(115, 'MACHINNING'),
(104, 'MECHANICAL TECHNICIAN '),
(106, 'PLC PROGRAMMER (ALLEN BRADLEY, SIEMENS)'),
(107, 'ROBOT PROGRAMMER (ABB) '),
(109, 'TRAVEL AND MOBILITY ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_proceso`
--

DROP TABLE IF EXISTS `catalogo_proceso`;
CREATE TABLE IF NOT EXISTS `catalogo_proceso` (
  `id_catPros` int NOT NULL AUTO_INCREMENT,
  `producto` varchar(700) NOT NULL,
  PRIMARY KEY (`id_catPros`),
  UNIQUE KEY `producto` (`producto`)
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `catalogo_proceso`
--

INSERT INTO `catalogo_proceso` (`id_catPros`, `producto`) VALUES
(11, 'ALUMINUM AND CASTING'),
(2, 'ALUMINUM COILING'),
(146, 'ALUMINUM DIECASTING'),
(3, 'ALUMINUM EXTRUSION'),
(4, 'ALUMINUM FOIL ROLLING'),
(5, 'ALUMINUM FORGING'),
(6, 'ALUMINUM GRAVITY CASTING'),
(7, 'ALUMINUM HARDENING (AGING)'),
(8, 'ALUMINUM LOW PRESSURE CASTING'),
(9, 'ALUMINUM PASSIVATION'),
(10, 'ALUMINUM RECYCLING'),
(12, 'ALUMINUM SQUEEZING'),
(13, 'ANNEALING'),
(14, 'ANODIZING'),
(15, 'ASSEMBLY'),
(16, 'ASSEMBLY AND SUB-ASSEMBLY OPERATIONS'),
(17, 'AUTOMATION'),
(18, 'AUTOMOTIVE LOGISTICS'),
(19, 'BENDING AND HYDROFORMING'),
(20, 'BLACK OXIDE COATING'),
(21, 'BLANKING'),
(145, 'BLOW MOLDING'),
(22, 'BLOWING'),
(23, 'CABLE ASSEMBLIES'),
(24, 'CALIBRATION SERVICES'),
(25, 'CARBURIZING AND NITRIDING'),
(26, 'CARPETING'),
(27, 'CASE HARDENING'),
(28, 'CATAPHORESIS'),
(29, 'CERAMIC MOLDING'),
(30, 'CHROMING'),
(31, 'CNC MACHINING'),
(32, 'COATING'),
(33, 'COATING AND POWDER PAINTING'),
(34, 'COMPRESSION'),
(35, 'CYANURIZING'),
(144, 'DEEP DRAW THIN WALL STAMPING'),
(36, 'DEMETALIZED'),
(37, 'DESIGN AND 3D PRINTING'),
(38, 'DIE CASTING'),
(40, 'ELECTRICAL PROJECT PLANNING'),
(41, 'FINISHING AND POLISHING'),
(130, 'FIXTURES MANUFACTURING'),
(42, 'FLOCKING'),
(43, 'FORGING (HOT AND COLD)'),
(44, 'FOUNDRY'),
(46, 'GALVANIZING AND TROPICALIZATION'),
(47, 'GAS ASSISTED INJECTION MOULDING'),
(48, 'GRINDING'),
(143, 'HPDC'),
(49, 'IMPRESSION-DIE DROP FORGING'),
(50, 'INDUCTION FORGING'),
(51, 'INDUSTRIAL MAINTENANCE & MACHINE REPAIR'),
(52, 'INDUSTRIAL METROLOGY'),
(141, 'INJECTED ALUMINUM PROCESS'),
(53, 'INJECTION'),
(54, 'INOX PASSIVATION'),
(55, 'INTELLIGENCE DATA AND PREDICTIVE ANALYTICS'),
(56, 'INVESTMENT CASTING'),
(58, 'IRON AND CASTING'),
(57, 'IRON PASSIVATION'),
(59, 'LAB AND QUALITY TESTS'),
(60, 'LABELLING AND PACKAGING'),
(61, 'LASER AND PLASMA CUTTING'),
(62, 'LEAN MANUFACTURING'),
(147, 'LITHIUM BATTERY RECYCLER FOR AUTOMOTIVE USE'),
(45, 'LOW PRESSURE ALUMINUM CASTING'),
(139, 'MACHINED IN SERIES'),
(63, 'MACHINING'),
(64, 'MARKING'),
(65, 'MASTERBATCH'),
(66, 'MATERIALS HANDLING'),
(67, 'METAL CRYOGENIZATION'),
(68, 'METAL CUTTING'),
(69, 'METAL EXTRUSION'),
(70, 'METAL IMPREGNATION'),
(71, 'METAL SPINNING'),
(72, 'MOLD AND DIE DESIGN'),
(73, 'MOLD AND DIE MAKING'),
(74, 'MOLD AND DIE REPAIR'),
(138, 'MOLDING MANUFACTURING'),
(75, 'NET-SHAPE AND NEAR-NET-SHAPE FORGING'),
(76, 'NICKEL PLATING'),
(77, 'NON DESTRUCTIVE TESTS (NDT)'),
(78, 'OPEN-DIE DROP FORGING'),
(79, 'ORIGINAL EQUIPMENT MANUFACTURER (OEM)'),
(80, 'PACKAGING'),
(81, 'PAINTING'),
(82, 'PIGMENT AND POWDER FOR ALUMINUM'),
(83, 'PLASTER CASTING'),
(84, 'PLASTIC CHROMING'),
(85, 'PLASTIC EXTRUSION'),
(86, 'PLASTIC MOLDING'),
(87, 'PLATING'),
(88, 'PLC PROGRAMMING'),
(89, 'PRECIOUS METAL COATING'),
(90, 'PRECISION CUTTING'),
(91, 'PROGRAMMING'),
(92, 'PUNCHING AND DRILLING'),
(93, 'REMANUFACTURING & AFTERMARKET'),
(94, 'ROLL FORMING'),
(95, 'ROTATIONAL MOLDING'),
(96, 'SANDBLAST AND METAL PICKLING'),
(97, 'SHEL MOLDING'),
(98, 'SHOT BLAST'),
(99, 'SLITTING AND COILING'),
(100, 'SMART MANUFACTURING & INDUSTRY 4.0'),
(101, 'SOFT TRIM'),
(102, 'SORTING AND RE-WORK'),
(103, 'SPECIAL COURT AND WATERJET'),
(104, 'STAMPING AND MICROSTAMPING'),
(140, 'STAMPINGS - AIRBAGS'),
(142, 'SUBASSEMBLIES'),
(105, 'SULFATIZING'),
(106, 'SULFINITIZACIÓN'),
(107, 'SURFACE TREATMENT'),
(108, 'TEMPERED AND ANNEALED'),
(109, 'TESTING AND CONTROL DEVICES'),
(110, 'THERMOFORMING'),
(129, 'TOOLINGS MANUFACTURING'),
(112, 'TUBE AND PIPE FABRICATION'),
(113, 'TUBING SRETCHING'),
(114, 'TURNING AND MILLING'),
(115, 'ULTRASONIC WELDING'),
(116, 'UPSET FORGING'),
(117, 'VACUUM MOLDING'),
(118, 'WATER PURIFICATION'),
(119, 'WEATHER-STRIPPING'),
(120, 'WELDED WIRE MESHING'),
(121, 'WELDING'),
(122, 'WELDING AND STEEL WORKS'),
(123, 'WIRE FORMS'),
(124, 'ZINC PLATING'),
(125, 'ZINC, MAGNESIUM, ALLOYS DIE CASTING');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_productos`
--

DROP TABLE IF EXISTS `catalogo_productos`;
CREATE TABLE IF NOT EXISTS `catalogo_productos` (
  `idproducto` int NOT NULL AUTO_INCREMENT,
  `producto` varchar(700) NOT NULL,
  PRIMARY KEY (`idproducto`),
  UNIQUE KEY `producto` (`producto`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `catalogo_productos`
--

INSERT INTO `catalogo_productos` (`idproducto`, `producto`) VALUES
(3, 'ABS COMPONENTS'),
(4, 'ACTUATORS AND ELECTROMECHANICAL COMPONENTS'),
(5, 'ADVANCED DRIVER ASSISTANCE SYSTEMS'),
(6, 'AIR BAG'),
(7, 'AIR COMPRESSORS'),
(8, 'ANTENNAS'),
(9, 'ANTI-STATIC BAGS'),
(10, 'ANTI-STATIC MATS'),
(11, 'ARMRESTS AND HEADRESTS'),
(12, 'AUDIO SYSTEMS'),
(13, 'AUTOMATED GUIDED VEHICLES (AGV)'),
(14, 'AUTOMOTIVE TEST DEVICES'),
(15, 'AXLES'),
(16, 'BAGS AND DUNNAGE'),
(17, 'BATTERIES'),
(241, 'BATTERIES FOR VEHICLES'),
(18, 'BEARINGS'),
(19, 'BEARINGS AND MOUNTS'),
(20, 'BELLOWS AND JOINTS'),
(21, 'BELTS'),
(22, 'BELTS AND DUCTS'),
(23, 'BODY FRAME'),
(24, 'BOLTS'),
(25, 'BOOTS AND GROMMETS'),
(26, 'BRACKETS'),
(27, 'BRAKE DISCS'),
(28, 'BRAKE HOSES'),
(29, 'BRAKE SYSTEMS'),
(30, 'BULK BAGS'),
(31, 'BUMPERS'),
(32, 'BUSHINGS'),
(33, 'CALIPERS AND BOOSTERS'),
(34, 'CAMSHAFTS'),
(35, 'CAR STEERING'),
(36, 'CAR UPHOLSTERY'),
(37, 'CARDBOARD AND PLASTIC BOXES'),
(231, 'CARDBOARD BOXES, PARTITIONS'),
(38, 'CARGO AND LUGGAGE MANAGEMENT SYSTEMS'),
(240, 'CARPET FLOOR MATS'),
(39, 'CATALYTIC CONVERTERS'),
(40, 'CHAINS'),
(41, 'CHASIS FRAME'),
(42, 'CIRCUIT BREAKERS'),
(43, 'CLAMPS'),
(44, 'CLINHES'),
(45, 'CLUTCHES'),
(46, 'CLUTCHES AND COOLERS'),
(47, 'COMFORT AND HEATING'),
(48, 'COMPONENTS AND EV CHARGING SYSTEMS'),
(50, 'CONNECTING RODS'),
(51, 'CONNECTORS AND TERMINALS'),
(52, 'CONSOLES'),
(53, 'CONTAINERS'),
(54, 'CONVERTERS AND INVERTERS'),
(55, 'CONVERTIBLE TOPS'),
(56, 'CONVEYORS AND FEEDERS'),
(57, 'CORRUGATED FIBERBOARD'),
(58, 'COUPLINGS'),
(59, 'COVERS AND CURTAINS'),
(60, 'CRANKSHAFTS'),
(61, 'CROSSMEMBERS AND SUSPENSION BEAMS'),
(62, 'CV AND U-JOINTS'),
(63, 'CYLINDER BLOCKS'),
(64, 'CYLINDERS'),
(65, 'DAMPERS'),
(227, 'DIE CASTING PARTS'),
(66, 'DIESEL ENGINES'),
(67, 'DIFFERENTIAL'),
(68, 'DISPLAYS AND COMPONENTS'),
(69, 'DOLLIES AND CARGO ROLLERS'),
(70, 'DOOR SYSTEMS'),
(71, 'DRIVE SHAFT'),
(225, 'ELECTRICAL /ELECTRIC PARTS'),
(243, 'ELECTRICAL CONTACTS'),
(246, 'ELECTROMECHANICAL ASSEMBLIES'),
(72, 'ELECTRONIC COMPONENTS'),
(73, 'ELECTRONIC ROTORS'),
(74, 'ELECTRONICS & EQUIPMENT INTEGRATORS'),
(75, 'EMISSION CONTROL'),
(76, 'ENGINE MANAGEMENT SYSTEMS & ELECTRONIC CONTROL UNIT (ECU)'),
(77, 'ENGINEERING PLASTICS'),
(78, 'EXHAUST PIPES'),
(79, 'EXHAUST SYSTEM'),
(80, 'EXHAUST SYSTEM BRACKETS'),
(81, 'EXTERIOR TRIM'),
(82, 'FANS'),
(83, 'FASTENERS'),
(84, 'FENDERS & FASCIAS'),
(85, 'FINISHES AND TAPESTRY'),
(86, 'FLOOR MATS'),
(87, 'FORKLIFTS'),
(88, 'FOUR-WHEEL DRIVE'),
(89, 'FRAME'),
(248, 'fsdfds'),
(90, 'FUEL FILTER'),
(91, 'FUEL INJECTION'),
(92, 'FUEL PUMPS'),
(93, 'FUEL SYSTEM HOSES'),
(94, 'FUEL SYSTEMS TANKS AND FUEL CAPS'),
(95, 'FURNITURE'),
(96, 'FUSES'),
(97, 'GASKETS'),
(98, 'GASOLINE ENGINES'),
(99, 'GAUGES'),
(239, 'GB/T 20234.2-2011 AC / GB/T 20234.3-2011 DTC ELECTRIC VEHICLE CHARGER'),
(100, 'GEARS'),
(101, 'GEARS AND DRIVE SHAFTS'),
(102, 'GENERAL BRAKING COMPONENTS'),
(103, 'GENERAL EXHAUST SYSTEM COMPONENTS'),
(104, 'GLOVE BOXES'),
(105, 'GRILLES AND EMBLEMS'),
(106, 'HANDLES'),
(107, 'HARNESSES'),
(108, 'HEADLINERS'),
(109, 'HMI AND SCADA SYSTEMS'),
(110, 'HOODS'),
(111, 'HOSES'),
(112, 'HUBS'),
(113, 'HYDRAULIC JACKS'),
(114, 'HYDRAULIC SYSTEMS'),
(115, 'INDUSTRIAL AND LEAN MANUFACTURING'),
(245, 'INJECTION MOLDING'),
(116, 'INSTRUMENT CLUSTERS'),
(117, 'INSTRUMENT PANELS'),
(118, 'INTAKE MANIFOLDS & THROTTLE BODY'),
(119, 'INTERIOR MIRRORS'),
(120, 'INTERIOR TRIM'),
(121, 'KNOBS AND BEZELS'),
(237, 'L9679 (ST) AIRBAG CONTROLLER'),
(122, 'LABELS'),
(123, 'LAMINATED GLASS'),
(124, 'LATCHES'),
(125, 'LEAF SPRINGS'),
(126, 'LIGHTING'),
(127, 'LIGHTING SYSTEMS'),
(128, 'LINKAGES'),
(242, 'LITHIUM-ION BATTERY PACK'),
(129, 'LOCKS AND KEYSETS'),
(130, 'LUGGAGE AND LOAD HANDLING'),
(222, 'MACHINING'),
(131, 'MANUAL PARKING BRAKE'),
(132, 'MANUAL TRANSMISSION'),
(133, 'MASTER CYLINDERS'),
(134, 'MODULAR DEVICES'),
(244, 'MOLDED RUBBER'),
(135, 'MOLDING'),
(136, 'MOTORS'),
(137, 'MUFFLERS'),
(138, 'NUTS'),
(236, 'NXP 6686 (NXP) RADIOCHIP'),
(139, 'OIL FILTERS'),
(140, 'ON BOARD RADAR & INFOTAINMENT SYSTEMS'),
(141, 'PACKAGE'),
(142, 'PALLETS'),
(226, 'PARTES FORJADAS'),
(143, 'PCBS AND EMS'),
(144, 'PEDALS'),
(145, 'PEDESTRIAN STACKERS'),
(229, 'PLASTIC BAGS'),
(146, 'PLASTIC FILMS AND WRAPPING'),
(147, 'POWERTRAIN'),
(148, 'PULLEYS'),
(149, 'RACKS'),
(150, 'RADIATORS'),
(151, 'REARVIEWS AND VISION CAMERA'),
(152, 'RELEASE AGENTS AND PURGING COMPOUNDS'),
(153, 'RESONATORS'),
(154, 'RETAINERS'),
(155, 'RINGS AND CLIPS'),
(156, 'ROBOTICS'),
(238, 'SAE J1772 ELECTRIC VEHICLE ADAPTER'),
(235, 'SAKTC265D-40F200WBB OR BC (INFINEON) ECU'),
(232, 'SCC 1000 STATIC SHIELD BAG'),
(157, 'SEALS'),
(158, 'SEAT ASSEMBLIES'),
(159, 'SEAT BELTS AND COMPONENTS'),
(160, 'SEAT CONTROLS'),
(161, 'SEAT COVER'),
(162, 'SEAT FRAME'),
(163, 'SEAT HARDWARE'),
(164, 'SEATS'),
(165, 'SENSORS'),
(166, 'SHAFTS'),
(167, 'SHEAVES'),
(223, 'SHEET METAL'),
(168, 'SHELVES AND CABINETS'),
(169, 'SHIFT ASSEMBLIES AND SHIFT LEVERS'),
(170, 'SHOCK ABSORBERS'),
(171, 'SIDE SKIRTS'),
(172, 'SOLENOIDS AND COILS'),
(173, 'SPACERS AND WASHERS'),
(224, 'SPARE PARTS'),
(234, 'SPC560P34L1BEAB (ST) AIRBAG CONTROLER'),
(233, 'SPC5674FAMVR3R (NXP) ENGINE ECU'),
(174, 'SPOILERS AND ROCKER PANELS'),
(175, 'SPRINGS'),
(176, 'SPROCKETS AND IDLERS'),
(177, 'STACKERS AND LIFTING PLATFORMS'),
(178, 'STAMPING PRESSES'),
(179, 'STEERING COLUMN'),
(180, 'STEERING GEARS & SHAFTS'),
(181, 'STEERING PINIONS AND RACKS'),
(182, 'STEERING PUMPS'),
(183, 'STEERING WHEELS AND COMPONENTS'),
(184, 'STORAGE SYSTEMS'),
(185, 'STRAPS'),
(186, 'SUNROOFS AND COMPONENTS'),
(187, 'SUSPENSION'),
(188, 'TAPES'),
(189, 'TENSION BANDS'),
(247, 'Termostatp'),
(190, 'THERMAL AND ISOLATION MATERIALS'),
(228, 'THERMOFORMED PARTS'),
(191, 'THERMOPLASTICS'),
(192, 'THERMOSTATS'),
(193, 'THROTTLE BODY'),
(194, 'TIRES'),
(195, 'TORSION TRACTION SYSTEMS'),
(196, 'TOTES AND TANKS'),
(197, 'TRAILER SYSTEM'),
(198, 'TRANSAXLES'),
(199, 'TRANSFER CASES'),
(200, 'TRANSMISSION CLUTCHES'),
(201, 'TRANSMISSION GEARS'),
(202, 'TRANSMISSION HOUSINGS'),
(203, 'TRAYS AND CASES'),
(204, 'TRIM AND PANELS'),
(205, 'TUBING'),
(206, 'VALVES AND COMPONENTS'),
(207, 'VALVETRAIN'),
(208, 'VENTILATION AND AIR CONDITIONING (HVAC) COMPONENTS'),
(209, 'VIBRATION CONTROL'),
(210, 'VISION AND CONTROL SYSTEMS'),
(211, 'VISUAL AND INDUSTRIAL SIGNS'),
(249, 'Volante'),
(212, 'WASHERS'),
(213, 'WAX'),
(214, 'WHEEL CYLINDERS'),
(215, 'WHEELS AND COMPONENTS'),
(216, 'WINDOW SYSTEMS AND COMPONENTS'),
(217, 'WIPER SYSTEMS AND COMPONENTS'),
(218, 'WIRING HARNESSES'),
(230, 'WOODEN PALLETS'),
(219, 'WORKSTATIONS AND CELLS'),
(220, 'WORKTABLES'),
(221, 'YOKES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_raw_material`
--

DROP TABLE IF EXISTS `catalogo_raw_material`;
CREATE TABLE IF NOT EXISTS `catalogo_raw_material` (
  `id` int NOT NULL AUTO_INCREMENT,
  `producto` varchar(700) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `producto` (`producto`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `catalogo_raw_material`
--

INSERT INTO `catalogo_raw_material` (`id`, `producto`) VALUES
(2, 'ADHESIVES'),
(3, 'ALLOYS'),
(30, 'ALUMINUM INGOTS'),
(57, 'ALUMINUM PARTS'),
(4, 'CABLES'),
(5, 'CARPETS'),
(6, 'CERAMICS'),
(7, 'CLEANING CHEMICALS'),
(8, 'COMPOSITE MATERIALS'),
(9, 'COMPOSITES '),
(10, 'COOLANTS'),
(11, 'CORROSION INHIBITORS'),
(12, 'CUTTING TOOLS'),
(58, 'DYES'),
(13, 'E-COATING AND POWDER COATING'),
(14, 'ENGINEERING PLASTICS'),
(15, 'FABRICS AND NON-WOVENS'),
(16, 'FERROUS METALS'),
(17, 'FIBER OPTIC WIRING'),
(18, 'FLAT BAR AND PROFILES'),
(19, 'FOAMS '),
(20, 'FUEL'),
(21, 'GLASS'),
(22, 'GLASS FIBER'),
(23, 'GREASES'),
(24, 'INDUSTRIAL ABRASIVE PRODUCTS'),
(25, 'INSULATION MATERIALS'),
(26, 'LAB EQUIPMENT'),
(27, 'LABEL PRINTERS AND SUPPLIES'),
(28, 'LAMINATES & FILMS'),
(29, 'LEATHER'),
(31, 'LUBRICANTS'),
(32, 'MEASURING AND PRECISION TOOLS'),
(33, 'METAL FRAMES'),
(34, 'METAL SHEETS'),
(35, 'NON-FERROUS METAL'),
(36, 'OILS'),
(56, 'PACKAGING THEMOFORMS , RAW PACK , METAL & PLASTIC ,HYBRID '),
(37, 'PAINTING'),
(38, 'PAINTS AND CLEANING CHEMICALS'),
(39, 'PAPER'),
(40, 'PLASTIC RESINES AND ADITIVES'),
(41, 'PLASTICS'),
(42, 'POLIMERS'),
(60, 'puerta'),
(43, 'RUBBER PARTS & COMPONENTS '),
(44, 'SEALANTS'),
(45, 'SHEETS AND PLASTIC FILMS'),
(46, 'SINTERING & METAL POWDER'),
(47, 'SOLVENTS & ADHESIVES '),
(48, 'SPARE PARTS MARKET'),
(49, 'STAINLESS STEEL '),
(50, 'STEEL'),
(51, 'STEEL TAPE'),
(52, 'TAPES'),
(53, 'TORQUE TIGHTENING TOOLS'),
(59, 'Volante'),
(54, 'WELDING SUPPLIES'),
(55, 'WIRES ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificacionescomprador`
--

DROP TABLE IF EXISTS `certificacionescomprador`;
CREATE TABLE IF NOT EXISTS `certificacionescomprador` (
  `idcertificacion` int NOT NULL AUTO_INCREMENT,
  `path` varchar(50) DEFAULT NULL,
  `listaCerts` varchar(300) DEFAULT NULL,
  `idcomprador` int NOT NULL,
  PRIMARY KEY (`idcertificacion`),
  UNIQUE KEY `idcomprador` (`idcomprador`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `certificacionescomprador`
--

INSERT INTO `certificacionescomprador` (`idcertificacion`, `path`, `listaCerts`, `idcomprador`) VALUES
(1, 'archivosUpload/Certs/rgvo8cx1hn.pdf', 'iso27001', 1),
(2, NULL, NULL, 2),
(3, 'archivosUpload/Certs/n7kdce9mws.pdf', 'iso 9001', 3),
(4, NULL, NULL, 4),
(5, 'archivosUpload/Certs/i3sfl6womz.pdf', 'iso9000', 5),
(6, NULL, NULL, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

DROP TABLE IF EXISTS `contacto`;
CREATE TABLE IF NOT EXISTS `contacto` (
  `ID_contacto` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) DEFAULT NULL,
  `Puesto` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Tel` int DEFAULT NULL,
  `Ext` int DEFAULT NULL,
  `Cel` int DEFAULT NULL,
  `ID_usuario` int NOT NULL,
  PRIMARY KEY (`ID_contacto`),
  KEY `ID_usuario` (`ID_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`ID_contacto`, `Nombre`, `Puesto`, `Email`, `Tel`, `Ext`, `Cel`, `ID_usuario`) VALUES
(1, 'Alejandro Morales', 'Ventas', 'comprasluisleon@gmail.com', 2147483647, 40, 4578963, 1),
(2, 'Hugo Patiño', 'Hugo Patiño', 'hugo.patino@tenneco.com', 558, 45, 2147483647, 2),
(3, 'Jesus Rodriguez', 'CFO', 'jesus.rodriguez@ford.com', 2147483647, 5, 2147483647, 3),
(4, 'Gerardo Soto', 'VENTAS', 'gerardo@gmail.com', 2147483647, 0, 2147483647, 4),
(5, 'Jose Murillo', 'CFO', 'henryforce15a98@gmail.com', 2147483647, 0, 2147483647, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_empresa`
--

DROP TABLE IF EXISTS `detalle_empresa`;
CREATE TABLE IF NOT EXISTS `detalle_empresa` (
  `ID_dtl_empresa` int NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(300) DEFAULT NULL,
  `Pagina_web` varchar(50) DEFAULT NULL,
  `Tel` varchar(15) DEFAULT NULL,
  `Ext` int DEFAULT NULL,
  `Ventas_anuales` int DEFAULT NULL,
  `Num_empleados` int DEFAULT NULL,
  `ID_archivo` int NOT NULL,
  `ID_direccion` int NOT NULL,
  PRIMARY KEY (`ID_dtl_empresa`),
  KEY `ID_archivo` (`ID_archivo`,`ID_direccion`),
  KEY `ID_direccion` (`ID_direccion`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `detalle_empresa`
--

INSERT INTO `detalle_empresa` (`ID_dtl_empresa`, `Descripcion`, `Pagina_web`, `Tel`, `Ext`, `Ventas_anuales`, `Num_empleados`, `ID_archivo`, `ID_direccion`) VALUES
(1, 'La mejor opcion de desarrollo ', 'www.wefe.com', '5519298176', 0, 154022, 150, 1, 1),
(2, 'Planta industrial de bujias', 'tenneco.com', '5557298800', 0, 140000, 10000, 2, 2),
(3, 'la ford', 'ford.com', '5555555555', 5, 1564454, 150, 3, 3),
(4, 'empresa de gestion automovil \r\n', '6547893124', '4569823147', 5, 100000, 100000, 4, 4),
(5, 'una descripcion', 'despachoavila.com', '5569088456', 55, 1560000, 14000, 5, 5),
(6, '', NULL, NULL, NULL, NULL, NULL, 6, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_producto`
--

DROP TABLE IF EXISTS `detalle_producto`;
CREATE TABLE IF NOT EXISTS `detalle_producto` (
  `ID_dtl_producto` int NOT NULL,
  `Tipo_material` varchar(50) DEFAULT NULL,
  `Volumen_anual` varchar(50) DEFAULT NULL,
  `Comentarios` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_dtl_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

DROP TABLE IF EXISTS `direccion`;
CREATE TABLE IF NOT EXISTS `direccion` (
  `ID_direccion` int NOT NULL AUTO_INCREMENT,
  `Calle` varchar(50) DEFAULT NULL,
  `Colonia` varchar(50) DEFAULT NULL,
  `N_Int` int DEFAULT NULL,
  `N_Ext` int DEFAULT NULL,
  `CP` int DEFAULT NULL,
  `Alcaldia` varchar(50) DEFAULT NULL,
  `ID_estado` int DEFAULT NULL,
  PRIMARY KEY (`ID_direccion`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`ID_direccion`, `Calle`, `Colonia`, `N_Int`, `N_Ext`, `CP`, `Alcaldia`, `ID_estado`) VALUES
(1, 'Av ticoman', 'Santa maria Ticoman', 401, 1133, 7330, 'GAM', 9),
(2, 'Pte 150', 'Industrial Vallejo', 0, 956, 2300, 'Azcapotzalco', 9),
(3, 'mariano edcobedo ', 'LA colonia', 12, 11, 7345, 'GAM', 9),
(4, 'la condesa', 'la condesa', 52, 456, 7648, 'Hidalgo', 9),
(5, 'av ticoman ', 'barrio la laguna ticoman', 10, 133, 73330, 'GAM', 9),
(6, '', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE IF NOT EXISTS `empresa` (
  `ID_empresa` int NOT NULL AUTO_INCREMENT,
  `Empresa` varchar(50) DEFAULT NULL,
  `ID_dtl_empresa` int NOT NULL,
  PRIMARY KEY (`ID_empresa`),
  KEY `ID_dtl_empresa` (`ID_dtl_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`ID_empresa`, `Empresa`, `ID_dtl_empresa`) VALUES
(1, 'WEFE', 1),
(2, 'Tenneco', 2),
(3, 'Ford', 3),
(4, 'RC Racing', 4),
(5, 'Despacho Avila', 5),
(6, 'Junamex', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exportrequeridas`
--

DROP TABLE IF EXISTS `exportrequeridas`;
CREATE TABLE IF NOT EXISTS `exportrequeridas` (
  `idexportaciones` int NOT NULL AUTO_INCREMENT,
  `idcomprador` int NOT NULL,
  `paisesExporta` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`idexportaciones`),
  KEY `idcomprador` (`idcomprador`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `exportrequeridas`
--

INSERT INTO `exportrequeridas` (`idexportaciones`, `idcomprador`, `paisesExporta`) VALUES
(1, 1, 'Afghanistan,Anguilla'),
(2, 2, 'Afghanistan'),
(3, 3, 'Afghanistan,Algeria'),
(4, 4, NULL),
(5, 5, 'Andorra,Antigua and Barbuda'),
(6, 6, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `ID_producto` int NOT NULL AUTO_INCREMENT,
  `Producto` varchar(50) DEFAULT NULL,
  `ID_req_producto` int DEFAULT NULL,
  `ID_usuario` int DEFAULT NULL,
  `ID_catalogo` int DEFAULT NULL,
  PRIMARY KEY (`ID_producto`),
  KEY `ID_dtl_producto` (`ID_req_producto`,`ID_usuario`,`ID_catalogo`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID_producto`, `Producto`, `ID_req_producto`, `ID_usuario`, `ID_catalogo`) VALUES
(1, 'AIR BAG', 1, 2, 1),
(2, 'ANODIZING', 2, 2, 2),
(3, 'ABS COMPONENTS', NULL, 1, 1),
(4, 'CARPETS', NULL, 1, 3),
(5, 'ADHESIVES', NULL, 1, 3),
(6, 'CAE SIMULATION', NULL, 1, 4),
(7, 'ANTENNAS', NULL, 1, 1),
(8, 'ANNEALING', NULL, 1, 2),
(9, 'ASSEMBLY', NULL, 1, 2),
(10, 'BRACKETS', NULL, 1, 1),
(11, 'ALUMINUM AND CASTING', NULL, 3, 2),
(12, 'CABLES', NULL, 3, 3),
(13, 'AIR BAG', NULL, 3, 1),
(14, 'BAGS AND DUNNAGE', NULL, 3, 1),
(15, 'CERAMICS', NULL, 3, 3),
(16, 'CATERING', NULL, 3, 4),
(17, 'ANTENNAS', NULL, 3, 1),
(18, 'ABS COMPONENTS', NULL, 4, 1),
(19, 'AIR BAG', NULL, 4, 1),
(20, 'CERAMICS', NULL, 4, 3),
(21, 'CABLES', NULL, 4, 3),
(22, 'CAE SIMULATION', NULL, 4, 4),
(23, 'ANODIZING', NULL, 4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requerimientos`
--

DROP TABLE IF EXISTS `requerimientos`;
CREATE TABLE IF NOT EXISTS `requerimientos` (
  `idrequerimiento` int NOT NULL AUTO_INCREMENT,
  `idcomprador` int NOT NULL,
  `commodity` varchar(800) NOT NULL,
  `tmateriales` varchar(800) NOT NULL,
  `volumenanual` int NOT NULL,
  `comentarios` text NOT NULL,
  `eliminado` int NOT NULL,
  PRIMARY KEY (`idrequerimiento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requerimiento_producto`
--

DROP TABLE IF EXISTS `requerimiento_producto`;
CREATE TABLE IF NOT EXISTS `requerimiento_producto` (
  `ID_req_producto` int NOT NULL AUTO_INCREMENT,
  `Tipo_material` varchar(50) DEFAULT NULL,
  `Volumen_anual` varchar(50) DEFAULT NULL,
  `Comentarios` varchar(200) DEFAULT NULL,
  `ID_usuario` int DEFAULT NULL,
  PRIMARY KEY (`ID_req_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `requerimiento_producto`
--

INSERT INTO `requerimiento_producto` (`ID_req_producto`, `Tipo_material`, `Volumen_anual`, `Comentarios`, `ID_usuario`) VALUES
(1, 'naylon', '1450000', 'none', 2),
(2, 'Aluminio', '150000', 'carga y descarga de material', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `ID_tipo_usr` int NOT NULL,
  `Tipo` varchar(25) NOT NULL,
  PRIMARY KEY (`ID_tipo_usr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`ID_tipo_usr`, `Tipo`) VALUES
(1, 'Tractora'),
(2, 'Proveedor'),
(3, 'Admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `ID_usuario` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `contrasenia` varchar(100) NOT NULL,
  `Estatus_mail` varchar(25) NOT NULL DEFAULT '0',
  `Estatus_pago` varchar(25) NOT NULL DEFAULT '0',
  `Fecha_pago` date NOT NULL,
  `Codigo_verificacion` varchar(25) NOT NULL,
  `ID_empresa` int NOT NULL,
  `ID_tipo_usr` int NOT NULL,
  PRIMARY KEY (`ID_usuario`),
  KEY `ID_empresa` (`ID_empresa`,`ID_tipo_usr`),
  KEY `ID_tipo_usr` (`ID_tipo_usr`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_usuario`, `usuario`, `contrasenia`, `Estatus_mail`, `Estatus_pago`, `Fecha_pago`, `Codigo_verificacion`, `ID_empresa`, `ID_tipo_usr`) VALUES
(1, 'luis15ago98@gmail.com', '$2y$10$8Kcb9PjqTIFi4yTlrsLiKu5Isw3Hxz795/oP/d38DZwz4xEX8R6.u', '1', '0', '0000-00-00', '332237', 1, 2),
(2, 'luisenriqueall@hotmail.com', '$2y$10$ifN8fp3gXAqtsg0v0c6toOgSia5XM9rLpfftQCkDO7461kobZIcxi', '1', '0', '0000-00-00', '145453', 2, 1),
(3, 'comprasluisleon@gmail.com', '$2y$10$rPg9PQludTIcg59WGqqcveaJQQBz.jRADW0iX5kVuhf0/d.zOswXa', '1', '0', '0000-00-00', '804998', 3, 2),
(4, 'comprasluisenriqueleon@gmail.com', '$2y$10$qpqp88MgeO8ELZA6p7makeG1tP.y.rh7vpL1xUGj21l9X780Ge6iW', '1', '0', '0000-00-00', '600173', 4, 2),
(5, 'henryforce15a98@gmail.com', '$2y$10$PR3RHGFPZPuNST3h2olDdOXDB39eoPfvUkxfcZ94ukk5bdk95J8yO', '1', '0', '0000-00-00', '528355', 5, 1),
(6, 'xompras@jugos.com', '$2y$10$nyd2svRNxg6puzCigHbAq.4z/5U077eRJB9BqxQBhU1SiitwaPJ0m', '1', '0', '0000-00-00', '610005', 6, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_empresa`
--
ALTER TABLE `detalle_empresa`
  ADD CONSTRAINT `detalle_empresa_ibfk_4` FOREIGN KEY (`ID_archivo`) REFERENCES `archivos` (`ID_archivo`),
  ADD CONSTRAINT `detalle_empresa_ibfk_5` FOREIGN KEY (`ID_direccion`) REFERENCES `direccion` (`ID_direccion`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`ID_tipo_usr`) REFERENCES `tipo_usuario` (`ID_tipo_usr`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
