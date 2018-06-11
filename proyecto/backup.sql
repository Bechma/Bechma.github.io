DROP TABLE biografia;

CREATE TABLE `biografia` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `texto` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO biografia VALUES("1","El grupo australiano AC/DC se formó en (Australia) en 1973, gracias a dos hermanos escoceses,Malcolm y Angus Young. El nombre del grupo, con connotaciones eléctricas, son las iniciales en\ninglés de Corriente alterna/ Corriente continua. Cuando el grupo se formó Angus apenas tenía 15 años,por lo que alguien le sugirió que se subiera al escenario vestido con el uniforme colegial.\nA partir de ese momento, aquella fue la enseña de la banda.");
INSERT INTO biografia VALUES("2","En 1974 los hermanos Young se trasladan a Melbourne, donde se unen al batería Phil Rudd y al bajista Mark Evans. Como antante se les unió Bon Scott, quien ya había participado anteriormente en algunas bandas de pop. Además, Scott aportó a la banda un estilo agresivo de chicos inadaptados que les acompañó a lo largo de su carrera. De esta forma, con la banda ya formada, realizan una gira por Australia, comenzando a trabajar en lo que sería su primer álbum.");
INSERT INTO biografia VALUES("3","En 1975 aparecen en Australia los dos primeros álbumes de AC/DC, titulados \"High voltage\" y \"T.N.T\".Un año más tarde firman contrato con la discográfica Atlantic Records, quienes editan \"High voltage\"\n para el Reino Unido, un nuevo álbum que mezcla temas de sus dos trabajos en Australia. Ese mismo año publican su primer trabajo propiamente británico, \"Dirty deeds done dirt cheap\".");
INSERT INTO biografia VALUES("4","En 1977 Evans abandona la banda y es sustituído por Cliff Williams, con quien comienzan publicando el álbum \"Let there be rock\", que se aupó al número uno de las listas americanas. Parte del éxito se lo deben a sus espectaculares conciertos en directo y a la energía que derrochan sobre el escenario.\nEn 1978 aparece publicado \"Powerage\", que precedió al primer gran éxito de la banda, \"Highway to hell\",un álbum con ventas millonarias y que entró en los primeros puestos de todas las listas, consiguiendo numerosos discos de oro. Poco después del éxito de \"Highway to hell\", el cantante de la banda, Bon Scott apareció muerto en Londres. AC/DC tuvo que recomponerse, uniéndose a la banda Brian Johnson en el lugar ocupado anteriormente\npor Scott.");
INSERT INTO biografia VALUES("5","El siguiente trabajo de AC/DC fue \"Back in black\", en 1980, que llegó a ser número uno en Inglaterra y Estados Unidos, vendiendo más de 10 millones de copias solamente en el país norteamericano. Se calcula que hasta la fecha se han\nvendido 44 millones del copias del álbum, lo que le colocaría como uno de los más vendidos de la historia.A partir de este momento, los trabajos anteriores de AC/DC comenzaron a venderse como rosquillas, lo que llevó a la banda a aprovechar el tirón en su siguiente disco.");
INSERT INTO biografia VALUES("6","En 1981 aparece \"For those about to rock\", con el que nuevamente conquistaron el mercado americano. Un año después, el batería Phil Rudd abandona la banda y es sustituído por Simon Wright. En 1983 se publica \"Flick of the switch\", con el que AC/DC comienza una etapa menos brillante en su historia. Los siguientes trabajos de la banda siguen con la línea descendente de ventas: \"Fly on the wall\" y el recopilatorio \"Who made who\" pertenecen a esta época del grupo.");
INSERT INTO biografia VALUES("7","En 1987 publican \"Blow up your video\", con el que se lanzaron a una gira en la que Malcom fue sustituído temporalmente\npor su primo Steve. tras la gira, Wright abandonó el grupo, siendo sustituído por Chris Slade, con amplia experiencia\nen diversos grupos.");
INSERT INTO biografia VALUES("8","En 1990 aparece un nuevo álbum de AC/DC, titulado \"The razors edge\", con el que llegan al número dos en las listas americanas, estando situados en listas durante más de un año consecutivo. En 1992 publican un disco en directo,\n\"AC/DC Live\".");
INSERT INTO biografia VALUES("9","El siguiente trabajo de la banda aparece en 1995, bajo el título de \"Ballbreaker\", de nuevo con Phil Rudd incorporado al grupo. El disco fue un enorme éxito, vendiendo varios millones de copias y estando en puestos\npreferentes en las listas de Estados Unidos.");
INSERT INTO biografia VALUES("10","En 1997 publican una caja con cinco CD\'s, como homenaje al fallecido Bon Scott.\nEn el año 2000 publican el álbum \"Stiff upper lip\", grabado en el estudio de Bryan Adams en Canadá. Para promocionar este disco realizaron una gira por innumerables países, entre ellos España. Precisamente, los hermanos Young estuvieron en la localidad madrileña de Leganés, para inaugurar una calle que lleva su nombre. Se da la circunstancia de que la placa que lleva el nombre de la calle\nfue robada el mismo día de la inauguración.");
INSERT INTO biografia VALUES("11","En Octubre de 2008, rompiendo un silencio de 8 años, AC/DC regresa a los estudios de grabación para publicar un nuevo trabajo, titulado \"Black ice\". El álbum contiene 15 nuevas canciones, entre las que destaca su primer single \'Rock \'n\' Roll train\'.\nFinalmente el 2014 publiclan su ultimo algun ROCK OR BUST.");



DROP TABLE canciones;

CREATE TABLE `canciones` (
  `Titulo` varchar(100) NOT NULL,
  `Duracion` varchar(10) NOT NULL,
  `Disco` varchar(100) NOT NULL,
  PRIMARY KEY (`Titulo`),
  KEY `Disco` (`Disco`) USING BTREE,
  CONSTRAINT `Disco` FOREIGN KEY (`Disco`) REFERENCES `discos` (`Nombre`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO canciones VALUES("All Screwed Up","4:40","Stiff Upper Lip");
INSERT INTO canciones VALUES("Back In Black","4:16","Back In Black");
INSERT INTO canciones VALUES("Beating Around the Bush","4:16","Highway To Hell");
INSERT INTO canciones VALUES("Can\'t Stand Still","3:42","Stiff Upper Lip");
INSERT INTO canciones VALUES("Can\'t Stop Rock \'N\' Roll","4:03","Stiff Upper Lip");
INSERT INTO canciones VALUES("Come And Get It","4:03","Stiff Upper Lip");
INSERT INTO canciones VALUES("Damned","3:52","Stiff Upper Lip");
INSERT INTO canciones VALUES("Get It Hot","2:37","Highway To Hell");
INSERT INTO canciones VALUES("Girls Got Rhythm","5:20","Highway To Hell");
INSERT INTO canciones VALUES("Give It Up","3:54","Stiff Upper Lip");
INSERT INTO canciones VALUES("Given The Dog a Bone","3:32","Back In Black");
INSERT INTO canciones VALUES("Have a Drink on Me","4:00","Back In Black");
INSERT INTO canciones VALUES("Hell Bells","5:13","Back In Black");
INSERT INTO canciones VALUES("Highway to Hell","3:30","Highway To Hell");
INSERT INTO canciones VALUES("Hold Me Back","4:00","Stiff Upper Lip");
INSERT INTO canciones VALUES("House Of Jazz","4:00","Stiff Upper Lip");
INSERT INTO canciones VALUES("Let Me Put my Love Into You","4:16","Back In Black");
INSERT INTO canciones VALUES("Love Hungry Man","4:20","Highway To Hell");
INSERT INTO canciones VALUES("Meltdown","3:44","Stiff Upper Lip");
INSERT INTO canciones VALUES("Night Prowler","6:17","Highway To Hell");
INSERT INTO canciones VALUES("Rock \'n\' Roll Ain\'t Noise Pollution","4:16","Back In Black");
INSERT INTO canciones VALUES("Safe In New York City","4:02","Stiff Upper Lip");
INSERT INTO canciones VALUES("Satellite Blues","3:50","Stiff Upper Lip");
INSERT INTO canciones VALUES("Shake a Leg","4:06","Back In Black");
INSERT INTO canciones VALUES("Shoot to Thrill","5:20","Back In Black");
INSERT INTO canciones VALUES("Shot Down in Flames","3:25","Highway To Hell");
INSERT INTO canciones VALUES("Stiff Upper Lip","3:34","Stiff Upper Lip");
INSERT INTO canciones VALUES("Touch Too Much","3:32","Highway To Hell");
INSERT INTO canciones VALUES("Walk All Over You","3:36","Highway To Hell");
INSERT INTO canciones VALUES("What Do You Do for Money Honey","3:36","Back In Black");
INSERT INTO canciones VALUES("You Shook Me All Night Long","5:20","Back In Black");



DROP TABLE conciertos;

CREATE TABLE `conciertos` (
  `Fecha` int(13) NOT NULL,
  `Lugar` varchar(100) NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`Fecha`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO conciertos VALUES("1234991700","Oslo(Noruega)","Actuarán en el recinto: Telenor Arena(25.000 espectadores)");
INSERT INTO conciertos VALUES("1235163600","Estocolmo(Suecia)","Actuarán en el recinto: Ericsson Globe (16.000 espectadores)");
INSERT INTO conciertos VALUES("1238109300","Múnich(Alemania)","Actuarán en el recinto: Olympiahalle (15.500 espectadores)");
INSERT INTO conciertos VALUES("1238706000","Madrid(España)","Actuarán en el recinto: Palacio de Deportes (17.500 espectadores)");
INSERT INTO conciertos VALUES("1240439400","Birmingham(Reino Unido)","Actuarán en el recinto: LG Arena (11.000 espectadores)");
INSERT INTO conciertos VALUES("1242594000","Milán(Italia)","Actuarán en el recinto: Mediolanum Forum (12.700 espectadores)");



DROP TABLE discos;

CREATE TABLE `discos` (
  `Nombre` varchar(200) NOT NULL,
  `Precio` varchar(10) NOT NULL,
  `FechaPublicacion` varchar(100) NOT NULL,
  `Imagen` varchar(100) NOT NULL,
  `Descripcion` text NOT NULL,
  PRIMARY KEY (`Nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO discos VALUES("Back In Black","20","1980","Imagenes/back.png","Back in Black es el séptimo álbum de estudio de la banda australiana de hard rock AC/DC, lanzado en 1980. Fue grabado en Bahamas y, por segunda vez, producido por Robert \"Mutt\" Lange, siendo Highway to Hell la primera ocasión. En este disco figura por primera vez como vocalista Brian Johnson, quien sustituyó a Bon Scott tras su trágica muerte. Las ventas internacionales del disco ascienden a más de 50 millones de copias,11​ Lo que lo convierte en el segundo más vendido de la historia de la música tras Thriller de Michael Jackson a pesar de nunca haber llegado al número 1 del Billboard 200. El álbum está dedicado a Bon Scott, la portada del disco (el logo de AC/DC sobre un fondo negro) es un claro homenaje al cantante fallecido.");
INSERT INTO discos VALUES("Highway To Hell","30","1979","Imagenes/highway.jpg","Highway to Hell (Autopista al infierno), es el sexto álbum de estudio de la banda de hard rock australiana AC/DC que salió a la venta en 1979. También es el quinto álbum de estudio internacional de la banda y todas sus canciones fueron escritas por Angus Young, Malcolm Young, y Bon Scott, entre las que se destacan \"Highway to Hell\", \"Touch Too Much\", \"Walk All Over You\", \"Shot Down in Flames\", \"If You Want Blood (You\'ve Got It)\" y el oscuro blues \"Night Prowler\". Se consideró el álbum más popular de la banda hasta el momento, y ayudó a incrementar la popularidad de ésta considerablemente, posicionándola para el éxito de su álbum Back In Black el año siguiente. Fue el último álbum grabado con el vocalista Bon Scott antes de que este muriese en febrero de 1980. Highway To Hell fue el primer álbum de AC/DC que no fue producido por Harry Vanda y George Young. En Australia, salió a la venta con una cubierta ligeramente diferente. A diferencia de la internacional, tenía llamas en la guitarra. En Alemania del Este se cambiaron los diseños de las carátulas.");
INSERT INTO discos VALUES("Stiff Upper Lip","19","2000","Imagenes/lip.jpg","Stiff Upper Lip es el decimocuarto álbum de estudio realizado en el año 2000 por la banda australiana de hard rock AC/DC donde destacan canciones como Stiff Upper Lip (que le da nombre al disco), Give It Up y Can\'t Stop Rock n\' Roll. Fue así su vuelta a los estudios de grabación después de años de ausencia. Precediendo al disco de Black Ice, éste no obtuvo el éxito esperado con tan sólo 2 millones de discos vendidos en todo el mundo a pesar de haber sido disco de platino en los Estados Unidos.");



DROP TABLE discospedidos;

CREATE TABLE `discospedidos` (
  `idpedidos` int(11) NOT NULL,
  `Nombrediscos` varchar(100) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  PRIMARY KEY (`idpedidos`,`Nombrediscos`),
  KEY `Discos` (`Nombrediscos`),
  CONSTRAINT `Discos` FOREIGN KEY (`Nombrediscos`) REFERENCES `discos` (`Nombre`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pedido` FOREIGN KEY (`idpedidos`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO discospedidos VALUES("7","Back In Black","4");
INSERT INTO discospedidos VALUES("8","Back In Black","3");
INSERT INTO discospedidos VALUES("8","Stiff Upper Lip","4");
INSERT INTO discospedidos VALUES("9","Back In Black","2");
INSERT INTO discospedidos VALUES("9","Highway To Hell","3");
INSERT INTO discospedidos VALUES("9","Stiff Upper Lip","4");
INSERT INTO discospedidos VALUES("10","Highway To Hell","1");
INSERT INTO discospedidos VALUES("10","Stiff Upper Lip","1");
INSERT INTO discospedidos VALUES("11","Back In Black","2");
INSERT INTO discospedidos VALUES("11","Highway To Hell","2");
INSERT INTO discospedidos VALUES("12","Back In Black","10");
INSERT INTO discospedidos VALUES("12","Highway To Hell","10");
INSERT INTO discospedidos VALUES("12","Stiff Upper Lip","10");
INSERT INTO discospedidos VALUES("13","Back In Black","6");
INSERT INTO discospedidos VALUES("14","Highway To Hell","12");
INSERT INTO discospedidos VALUES("14","Stiff Upper Lip","30");
INSERT INTO discospedidos VALUES("15","Highway To Hell","1");



DROP TABLE log;

CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

INSERT INTO log VALUES("1","Usuario con email: admin@admin.com y rol admin se ha logueado");
INSERT INTO log VALUES("2","Usuario con email: admin@admin.com y rol admin se ha logueado");
INSERT INTO log VALUES("3","Usuario con email: nono@nono.nono y rol gestor se ha logueado");
INSERT INTO log VALUES("4","El usuario nono@nono.nono ha gestionado un pedido");
INSERT INTO log VALUES("5","El usuario nono@nono.nono ha hecho logout");
INSERT INTO log VALUES("6","Usuario con email: admin@admin.com y rol admin se ha logueado");
INSERT INTO log VALUES("7","Usuario con email: nono@nono.nono y rol gestor se ha logueado");
INSERT INTO log VALUES("8","Usuario con email: nono@nono.nono y rol gestor se ha logueado");
INSERT INTO log VALUES("9","El usuario nono@nono.nono ha gestionado un pedido");
INSERT INTO log VALUES("10","Usuario con email: asdf@asdf.com y rol admin se ha logueado");
INSERT INTO log VALUES("11","El usuario asdf@asdf.com ha insertado un nuevo usuario");
INSERT INTO log VALUES("12","El usuario asdf@asdf.com ha hecho logout");
INSERT INTO log VALUES("13","Intento fallido de login: email=admin@admin.com pass=admin");
INSERT INTO log VALUES("14","Intento fallido de login: email=admin@admin.com pass=123");
INSERT INTO log VALUES("15","Usuario con email: asdf@asdf.com y rol admin se ha logueado");
INSERT INTO log VALUES("16","El usuario asdf@asdf.com ha borrado un usuario");
INSERT INTO log VALUES("17","El usuario asdf@asdf.com ha insertado un nuevo usuario");
INSERT INTO log VALUES("18","El usuario asdf@asdf.com ha hecho logout");
INSERT INTO log VALUES("19","Usuario con email: admin@admin.com y rol admin se ha logueado");
INSERT INTO log VALUES("20","El usuario admin@admin.com ha borrado un usuario");
INSERT INTO log VALUES("21","El usuario admin@admin.com ha borrado un usuario");
INSERT INTO log VALUES("22","El usuario admin@admin.com ha borrado un usuario");
INSERT INTO log VALUES("23","Compra de discos realizada 10/06/2018 12:26");
INSERT INTO log VALUES("24","Compra de discos realizada 10/06/2018 12:28");
INSERT INTO log VALUES("25","Compra de discos realizada 10/06/2018 12:30");
INSERT INTO log VALUES("26","El usuario admin@admin.com ha hecho logout");
INSERT INTO log VALUES("27","Usuario con email: gestor@gestor.com y rol gestor se ha logueado");
INSERT INTO log VALUES("28","El usuario gestor@gestor.com ha gestionado un pedido");
INSERT INTO log VALUES("29","El usuario gestor@gestor.com ha gestionado un pedido");
INSERT INTO log VALUES("30","Compra de discos realizada 10/06/2018 12:35");
INSERT INTO log VALUES("31","Compra de discos realizada 10/06/2018 12:39");
INSERT INTO log VALUES("32","El usuario gestor@gestor.com ha gestionado un pedido");
INSERT INTO log VALUES("33","El usuario gestor@gestor.com ha gestionado un pedido");
INSERT INTO log VALUES("34","El usuario gestor@gestor.com ha hecho logout");
INSERT INTO log VALUES("35","Usuario con email: admin@admin.com y rol admin se ha logueado");
INSERT INTO log VALUES("36","El usuario admin@admin.com ha insertado un nuevo usuario");
INSERT INTO log VALUES("37","El usuario admin@admin.com ha hecho logout");
INSERT INTO log VALUES("38","Usuario con email: gestor2@gestor.com y rol gestor se ha logueado");
INSERT INTO log VALUES("39","Compra de discos realizada 10/06/2018 12:54");
INSERT INTO log VALUES("40","Compra de discos realizada 10/06/2018 12:59");
INSERT INTO log VALUES("41","El usuario gestor2@gestor.com ha gestionado un pedido");
INSERT INTO log VALUES("42","El usuario gestor2@gestor.com ha gestionado un pedido");
INSERT INTO log VALUES("43","Compra de discos realizada 10/06/2018 13:04");
INSERT INTO log VALUES("44","El usuario gestor2@gestor.com ha hecho logout");
INSERT INTO log VALUES("45","Usuario con email: admin@admin.com y rol admin se ha logueado");
INSERT INTO log VALUES("46","El usuario admin@admin.com ha insertado un nuevo usuario");
INSERT INTO log VALUES("47","Usuario con email: admin@admin.com y rol admin se ha logueado");
INSERT INTO log VALUES("48","Compra de discos realizada 10/06/2018 14:19");
INSERT INTO log VALUES("49","Usuario con email: gestor@gestor.com y rol gestor se ha logueado");
INSERT INTO log VALUES("50","El usuario gestor@gestor.com ha gestionado un pedido");
INSERT INTO log VALUES("51","El usuario admin@admin.com ha hecho logout");
INSERT INTO log VALUES("52","Usuario con email: gestor@gestor.com y rol gestor se ha logueado");
INSERT INTO log VALUES("53","El usuario gestor@gestor.com ha hecho logout");
INSERT INTO log VALUES("54","Usuario con email: admin@admin.com y rol admin se ha logueado");
INSERT INTO log VALUES("55","Intento fallido de login: email=admin@admin.com pass=asdf");
INSERT INTO log VALUES("56","Usuario con email: admin@admin.com y rol admin se ha logueado");



DROP TABLE miembros_grupo;

CREATE TABLE `miembros_grupo` (
  `Nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `Roll` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Fechanacimiento` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `Lugarnacimiento` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `Fotografia` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `Biografia` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO miembros_grupo VALUES("Angus Mckinnon Young","Guitarra Principal","31 de marzo de 1955","Glasgow, Escocia, Reino Unido1​2​","Imagenes/angus.jpg","Angus McKinnon Young (Glasgow, Escocia, 31 de marzo de 1955) es un músico nacido en Glasgow, conocido por ser uno de los miembros fundadores y el principal guitarrista del grupo AC/DC, aparte de ser el único miembro que permaneció en la banda desde su inicio.\n\nFue introducido en el Salón de la fama del Rock and Roll junto a los miembros actuales de la banda en el 2003. Era conocido por sus salvajes y enérgicos movimientos en el escenario, y su peculiar uniforme de colegial. Además, en el año 2014 se situó en el puesto número 96 de los 100 mejores guitarristas de todos los tiempos, concedido por la revista Rolling Stone,3​ y en el puesto 24 en una nueva edición de 2011 de los 100 mejores guitarristas de todos los tiempos, también por la revista Rolling Stone,4​ y en el puesto número 20 de la lista \"los 100 mejores guitarristas\", de la revista Total Guitar.5​");
INSERT INTO miembros_grupo VALUES("Brian Francis Johnson De Luca","Volcalista","5 de octubre de 1947 ","Dunston","Imagenes/Brian_Johnson.jpg","Brian Francis Johnson De Luca (Dunston, 5 de octubre de 1947) es un cantante británico conocido por ser el vocalista de AC/DC el cual, a su vez, había reemplazado a Bon Scott tras la muerte de éste en 1980. Su primer álbum como vocalista de AC/DC fue Back In Black. Tenía una voz innovadora en las bandas de rock de aquella época. Está situado en el puesto número 39 en la lista de los 100 mejores vocalistas de metal de todos los tiempos de la revista Hit Parader.1​ En 2016, tras diagnosticársele problemas auditivos, se vio obligado a abandonar su carrera como vocalista de forma indefinida, siendo sustituido por Axl Rose como vocalista de AC/DC para la gira Rock or Bust.2​.");
INSERT INTO miembros_grupo VALUES("Clifford Williams","Bajista","14 de diciembre de 1949","Romford, Inglaterra","Imagenes/cliff.jpg","Clifford Williams (nacido el 14 de diciembre de 1949 en Romford, Inglaterra), es un bajista británico, más conocido por haber sido miembro de la banda de hard rock AC/DC. Es el padre de Erin Williams, actriz y modelo, más conocida como Erin Lucas.\nSe mudó con su familia a Liverpool cuando tenía 9 años, para luego unirse a su primera banda, Home, a los 13. Debido a su edad, no tuvo el éxito que ansiaba con esta banda, ya que al solo tener 13 años no podía entrar en clubes para tocar. Con Home fueron teloneros de Led Zeppelin. Luego se trasladó a Londres nuevamente con su banda para probar suerte, aquí se le presentaron muchas oportunidades y ganó mucha experiencia, tocando con muchas bandas y solistas.\n\nEstuvo en varias bandas más hasta que entró a Bandit, que rápidamente se hizo al apoyo de Arista Records y lanzó su álbum debut. Junto a Cliff, en Bandit se encontraban artistas reconocidos como Jim Diamond (quien más tarde lograría éxito como solista) y el baterista Graham Broad (quien más tarde sería parte de la banda de Roger Waters).");
INSERT INTO miembros_grupo VALUES("Malcolm Mitchell Young","Guitarra Ritmica","06 de enero de 1953","Glasgow, Escocia, Reino Unido","Imagenes/malcolm.jpg","Malcolm Young (Glasgow, Escocia, 6 de enero de 1953-Elizabeth Bay, Sidney, Australia, 18 de noviembre de 2017) fue un guitarrista, compositor y productor discográfico de rock y blues, conocido por ser fundador, guitarrista rítmico, corista y miembro letrista de la popular banda australiana AC/DC.1​2​3​4​\n\nPese a estar siempre a la sombra de su hermano menor, Angus Young, fue el responsable de la amplia extensión del sonido, el desarrollo de los riffs de guitarras, la composición de la mayoría de las letras y la producción del material discográfico del grupo.5​6​7​\n\nEs considerado uno de los más grandes exponentes del rock de la guitarra rítmica. Fue incluido en el Salón de la Fama del Rock en 2003, junto con los demás integrantes de AC/DC.8​9​\n\nFormó parte de la banda AC/DC desde su fundación, en 1973, hasta 2014. Ese año el grupo da a conocer, mediante un comunicado de prensa, su retiro profesional por complicaciones de salud. No obstante, y pese a la sensible baja de su mentor, la banda informó que continuaría haciendo música.10​11​12​ Fue relevado por su sobrino Stevie Young, quien ya lo había reemplazado momentáneamente en 1988.13​14​15​");
INSERT INTO miembros_grupo VALUES("Phil Rudd","Bateria","19 de mayo de 1954","Melbourne, Victoria, Australia","Imagenes/phil-rudd.jpg","es un baterista australiano de hard rock. Conocido por haber sido el baterista de AC/DC, es considerado el baterista original de la banda, junto con Cliff Williams y los hermanos Young conforma la formación clásica del grupo. Su etapa en AC/DC comprende desde 1975 a 1983, y posteriormente desde 1994 hasta 2014. Desde la salida del grupo por parte de Mark Evans, se convirtió en el único integrante australiano del grupo. Junto con los hermanos Young, Cliff Williams y Brian Johnson, ingresó al Rock and Roll Hall of Fame, en 2003.");



DROP TABLE pedidos;

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `EmailGestor` varchar(255) DEFAULT NULL,
  `Fecha` varchar(50) NOT NULL,
  `Estado` varchar(30) NOT NULL,
  `TextoEmail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `EmailGestor` (`EmailGestor`) USING BTREE,
  CONSTRAINT `EmailGestor` FOREIGN KEY (`EmailGestor`) REFERENCES `usuarios` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

INSERT INTO pedidos VALUES("7","gestor@gestor.com","10/06/2018 12:26","Aceptado","Gracias por su compra Antonio Jaimez");
INSERT INTO pedidos VALUES("8","gestor@gestor.com","10/06/2018 12:28","Denegado","Fallo en el cobro");
INSERT INTO pedidos VALUES("9","","10/06/2018 12:30","En Espera","Gracias por su compra Miguel Arredondo");
INSERT INTO pedidos VALUES("10","gestor@gestor.com","10/06/2018 12:35","Aceptado","Gracias por su compra Jose Maria Gutierrez");
INSERT INTO pedidos VALUES("11","gestor@gestor.com","10/06/2018 12:39","Denegado","Operacion rechazada");
INSERT INTO pedidos VALUES("12","gestor2@gestor.com","10/06/2018 12:54","Denegado","Pedido demasiado grande, contacte con atencion al cliente");
INSERT INTO pedidos VALUES("13","gestor2@gestor.com","10/06/2018 12:59","Aceptado","Gracias por su compra Fernando Alonso");
INSERT INTO pedidos VALUES("14","","10/06/2018 13:04","En Espera","Gracias por su compra Guillermo Puertas");
INSERT INTO pedidos VALUES("15","gestor@gestor.com","10/06/2018 14:19","Denegado","Gracias por su compra Miguel gimenez");



DROP TABLE usuarios;

CREATE TABLE `usuarios` (
  `Nombre` varchar(255) NOT NULL,
  `Apellidos` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `TipoUser` varchar(255) NOT NULL,
  `Telefono` varchar(255) NOT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO usuarios VALUES("Otro","Administrador","admin2@admin.com","21232f297a57a5a743894a0e4a801fc3","admin","644932190");
INSERT INTO usuarios VALUES("Administrador","Ficticio","admin@admin.com","21232f297a57a5a743894a0e4a801fc3","admin","654321098");
INSERT INTO usuarios VALUES("Otro","Gestor","gestor2@gestor.com","13f323133114e52cb8534cf096bc50d3","gestor","675839098");
INSERT INTO usuarios VALUES("Gestor","Ficticio","gestor@gestor.com","a55607442fca264cf37e935503d646c2","gestor","666666666");



