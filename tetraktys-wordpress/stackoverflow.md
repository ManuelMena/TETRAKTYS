[![sistema estandarizado de nomenclatura médica](https://www.snomed.org/)
------------
Que es Snomed-CT®? y como puedo crear un servidor con Google Cloud y Tomcat®?
------------
[Snomed-CT](https://www.snomed.org/snomed-ct) es la base de datos mas extensa de conceptos **médicos** con mas de 311.000 referencias y 1.6 millones de relaciones conceptuales; desarrollado por la liberia medica nacional de los Estados Unidos usando languaje de ontologias web[OWL](https://www.w3.org/OWL/). OWL es un lenguaje de distribucion ontologica de datos que se compone de tecnologías como: lenguaje extensible de marcado[XML](https://www.w3.org/XML/), marco de distribucción de recursos[RDF](https://www.w3.org/RDF/), lenguaje de transformaciones XLS[XSLT](https://www.w3.org/Style/XSL/), ademas de diversos estandares semánticos que desarrolla el [consorcio de la web](https://www.w3.org/); OWL es un lenguaje semántico diseñado para que las maquinas entienda los datos que se le ingresan. Este framework esta diseñado con el desafío de traer al español todas estas herramientas para registro de historia clínica y sistemas de soporte de decisiones. Escalando proyectos en la nube, tipo SaaS, PaaS e IaaS,  basados en el modelo de Kubernetes para el desarrollo de software de código abierto y de distribución libre, que integre todas las tecnologías radicales de la web 3.0 como [BIG DATA](https://www.w3.org/blog/2016/10/w3c-and-big-data/), [ML](https://www.w3.org/community/ml-schema/), [IA](https://ai.google/), [IoT](https://www.w3.org/standards/webofdevices/), web semántica y todos los [estandares](https://www.w3.org/standards/) de los grupos de desarrollo de la web.

[Ejemplo de una app para diagnóstico por Zonas](http://edsnomedct.azurewebsites.net/)
![edsnomedct](https://storage.googleapis.com/tetraktys/edsnomed.png)

Esta es la secuencia de comando es para crear una API con JAVA que distribuye libremente **westcoastinformatics, LLC**. sugerimos probar el esquema de desarrollo en Google Cloud y probar cada comando, necesitamos sugerencias o descubrir si esta bien hasta ahora. Gracias.

[Demo online del servidor](https://umls.terminology.tools/#/landing)
![UMLS-tools](https://storage.googleapis.com/tetraktys/umlstools.png)

## Crear instancia de VM con Tomcat®
https://console.cloud.google.com/launcher/details/click-to-deploy-images/tomcat
## Instalar requerimientos en el SSH
### Instalar maven
```debian
$ sudo apt-get install maven
```
### Instalar Servidor de MySQL 5.6
```linux
$ sudo apt-get install mysql-server
$ sudo su 
$ echo "CREATE database snomeddb CHARACTER SET utf8 default collate utf8_bin;" | mysql
```
# SETUP snomed
```linux
$ mkdir ~/snomed
```
## Crear directorio data
```linux
$ mkdir ~/snomed
$ cd ~/snomed
$ mkdir config data
$ git clone https://github.com/WestCoastInformatics/UMLS-Terminology-Server.git code
```
## Crear directorio code
```linux
$ cd ~/snomed/code
$ git pull
$ mvn -Dconfig.artifactId=term-server-config-prod-snomedct clean install
```
## Descomprimir datos de muestra
```linux
$ cd ~/snomed/code
$ unzip ~/snomed/code/config/target/term*.zip -d ~/snomed/data
```
## Descomprimir configuración y scripts
```linux
$ cd ~/snomed
$ unzip ~/snomed/code/config/prod-snomedct/target/term*.zip -d config
$ ln -s config/bin
```
## Revisar QA despues de cargar
```linux
$ cd ~/snomed/code/admin/qa
$ mvn install -PDatabase -Drun.config.snomed=/home/ec2-tomcat/config/config.properties
```
### editar ```JAVA_OPTS``` 
```debian
$ cd $CATALINA_HOME/etc/tomcat8 && sudo nano tomcat8.conf
```
#### cambiar <Plugin java></Plugin>
```config
<Plugin java>
  JAVA_OPTS "-Drun.config.snomed=/home/ec2-tomcat/snomed/config/config.properties file"
</Plugin>
```
## Recargar Datos
### Desanudar e iniciar la página de mantenimiento
```linux
$ /bin/rm -rf /var/lib/tomcat8/work/Catalina/localhost/snomed-server-rest
$ /bin/rm -rf /var/lib/tomcat8/webapps/snomed-server-rest
$ /bin/rm -rf /var/lib/tomcat8/webapps/snomed-server-rest.war
$ /opt/maint/getMaintHtml.sh start snomed
```
## Desplegar Datos
```linux
$ cd ~/snomed/data
$ wget https://wci1.s3.amazonaws.com/TermServer/snomed.sql.gz
$ mysqls < ~/snomed/code/admin/mojo/src/main/resources/truncate_all.sql
$ gunzip -c snomed.sql.gz | mysqls &
$ wait
$ mysqls < ~/fixWindowsExportData.sql
$ /bin/rm ~/snomed/data/snomed.sql.gz
```
## Recomputar indexes
```linux
$ /bin/rm -rf /var/lib/tomcat8/indexes/snomedct/*
$ cd ~/snomed/code/admin/lucene
$ mvn install -PReindex  -Drun.config.umls=/home/ec2-tomcat/snomed/config/config.properties >&! mvn.log &
```
## Desplegar y remover pagina de mantenimiento
```linux
$ /bin/cp -f ~/snomed/code/rest/target/umls-server-rest*war /var/lib/collectd/webapps/snomed-server-rest.war
$ /opt/maint/getMaintHtml.sh stop snomed
```
### Recuerde eliminar snomed.sql cuando haya terminado (ocupa mucho espacio)
### INSTRUCCIONES DE REEMPLEO
```linux
$ cd ~/snomed/code
$ git pull
$ mvn -Drun.config.label=ts -Dconfig.artifactId=term-server-config-prod-snomedct clean install
```
```linux
$ /bin/rm -rf /var/lib/tomcat8/work/Catalina/localhost/snomed-server-rest
$ /bin/rm -rf /var/lib/tomcat8/webapps/snomed-server-rest
$ /bin/rm -rf /var/lib/tomcat8/webapps/snomed-server-rest.war
$ /bin/cp -f ~/snomed/code/rest/target/umls-server-rest*war /var/lib/tomcat8/webapps/snomed-server-rest.war
```


  [1]: https://i.stack.imgur.com/kCVlN.png