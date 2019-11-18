# TUGAS BDT MONGODB

# Implementasi Cluster MongoDB

## Spesifikasi
Vagrant
IP Config server 1 : 192.168.16.51 <br />
IP Config server 2 : 192.168.16.52 <br />
IP Query Router    : 192.168.16.53 <br />
IP Shard server 1  : 192.168.16.54 <br />
IP Shard server 2  : 192.168.16.55 <br />
IP Shard server 3  : 192.168.16.56 <br />
Dataset            : https://www.kaggle.com/ramu237/shoes-dataset <br />

## Proses Implementasi
2. Jalankan perintah dibawah untuk membuat file ``VagrantFile`` <br />
``` 
Vagrant Init 
```
3. Modifikasi file ``VagrantFile`` menjadi sebagai berikut <br />
```
# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

  config.vm.define "mongo_config_1" do |mongo_config_1|
    mongo_config_1.vm.hostname = "mongo-config-1"
    mongo_config_1.vm.box = "bento/ubuntu-18.04"
    mongo_config_1.vm.network "private_network", ip: "192.168.16.51"
    
    mongo_config_1.vm.provider "virtualbox" do |vb|
      vb.name = "mongo-config-1"
      vb.gui = false
      vb.memory = "1024"
    end

    mongo_config_1.vm.provision "shell", path: "sh/allhosts.sh", privileged: false
  end

  config.vm.define "mongo_config_2" do |mongo_config_2|
    mongo_config_2.vm.hostname = "mongo-config-2"
    mongo_config_2.vm.box = "bento/ubuntu-18.04"
    mongo_config_2.vm.network "private_network", ip: "192.168.16.52"
    
    mongo_config_2.vm.provider "virtualbox" do |vb|
      vb.name = "mongo-config-2"
      vb.gui = false
      vb.memory = "1024"
    end

    mongo_config_2.vm.provision "shell", path: "sh/allhosts.sh", privileged: false
  end

  config.vm.define "mongo_query_router" do |mongo_query_router|
    mongo_query_router.vm.hostname = "mongo-query-router"
    mongo_query_router.vm.box = "bento/ubuntu-18.04"
    mongo_query_router.vm.network "private_network", ip: "192.168.16.53"
    
    mongo_query_router.vm.provider "virtualbox" do |vb|
      vb.name = "mongo-query-router"
      vb.gui = false
      vb.memory = "1024"
    end

    mongo_query_router.vm.provision "shell", path: "sh/allhosts.sh", privileged: false
  end

  config.vm.define "mongo_shard_1" do |mongo_shard_1|
    mongo_shard_1.vm.hostname = "mongo-shard-1"
    mongo_shard_1.vm.box = "bento/ubuntu-18.04"
    mongo_shard_1.vm.network "private_network", ip: "192.168.16.54"
        
    mongo_shard_1.vm.provider "virtualbox" do |vb|
      vb.name = "mongo-shard-1"
      vb.gui = false
      vb.memory = "1024"
    end

    mongo_shard_1.vm.provision "shell", path: "sh/allhosts.sh", privileged: false
  end

  config.vm.define "mongo_shard_2" do |mongo_shard_2|
    mongo_shard_2.vm.hostname = "mongo-shard-2"
    mongo_shard_2.vm.box = "bento/ubuntu-18.04"
    mongo_shard_2.vm.network "private_network", ip: "192.168.16.55"
    
    mongo_shard_2.vm.provider "virtualbox" do |vb|
      vb.name = "mongo-shard-2"
      vb.gui = false
      vb.memory = "1024"
    end

    mongo_shard_2.vm.provision "shell", path: "sh/allhosts.sh", privileged: false
  end

  config.vm.define "mongo_shard_3" do |mongo_shard_3|
    mongo_shard_3.vm.hostname = "mongo-shard-3"
    mongo_shard_3.vm.box = "bento/ubuntu-18.04"
    mongo_shard_3.vm.network "private_network", ip: "192.168.16.56"
    
    mongo_shard_3.vm.provider "virtualbox" do |vb|
      vb.name = "mongo-shard-3"
      vb.gui = false
      vb.memory = "1024"
    end

    mongo_shard_3.vm.provision "shell", path: "sh/allhosts.sh", privileged: false
  end

end

```

4. Membuat script provision untuk ``allhosts.sh``
```
# Add hostname
sudo cp /vagrant/sources/hosts /etc/hosts

# Copy APT sources list
sudo cp /vagrant/sources/sources.list /etc/apt/
sudo cp /vagrant/sources/mongodb-org-4.2.list /etc/apt/sources.list.d/

# Add MongoDB repo key
sudo apt-get install gnupg
wget -qO - https://www.mongodb.org/static/pgp/server-4.2.asc | sudo apt-key add -

# Update Repository
sudo apt-get update
# sudo apt-get upgrade -y

# Install MongoDB
sudo apt-get install -y mongodb-org

# Start MongoDB
sudo service mongod start
```

5. Membuat file sources untuk ``hosts`` <br />
```
192.168.16.51 mongo-config-1
192.168.16.52 mongo-config-2
192.168.16.53 mongo-query-router
192.168.16.54 mongo-shard-1
192.168.16.55 mongo-shard-2
192.168.16.56 mongo-shard-3
```
6. Mendownload sources yang dibutuhkan ( ``mongo-keyfile , mongodb-org-4.2.list , sources.list`` ) <br />
7. Menjalankan vagrant dengan <br /> 
``` 
vagrant up 
``` 
8.  Buat user admin di salah satu server config ( untuk contoh ini di config 1). <br />
9. Masuk ke config 1 dengan  <br />
``` 
vagrant ssh mongo_config_1
``` 
10. Jalankan `` mongo `` untuk masuk ke shell mongo <br />
11. Jalankan `` use admin `` untuk mengubah database ke admin <br />
12. Membuat user admin dengan perintah 
``` 
db.createUser({user: "mongo-admin", pwd: "password", roles:[{role: "root", db: "admin"}]}) 
``` 
sehingga terbentuk user dengan username mongo-admin dan password password <br />
13. Di setiap config server ( config server 1 dan config server 2) , ubah ``/etc/mongod.conf`` sehingga ``bindIp`` menjadi IP masing-masing, uncomment replication dan tambahkan ``replSetName: configReplSet`` di bawahnya serta uncomment sharding dan tambahkan `` clusterRole: "configsvr"`` di bawahnya. <br />
14. Jalankan <br />
```
sudo systemctl restart mongod
```
15. Di salah satu config server ( config 1) , jalankan <br />
```
mongo mongo-config-1:27019 -u mongo-admin -p --authenticationDatabase admin
```
dengan password ``password`` <br />
16. Pada shell mongo, jalankan  <br />
```
rs.initiate( { _id: "configReplSet", configsvr: true, members: [ { _id: 0, host: "mongo-config-1:27019" }, { _id: 1, host: "mongo-config-2:27019" } ] } )
```
17. Pindah ke mongo_query_router. <br />
18. Buat file baru dengan  <br />
```
sudo nano /etc/mongos.conf
```
19. Modifikasi isi dari ``/etc/mongos.conf`` menjadi <br />
```
# where to write logging data.
systemLog:
  destination: file
  logAppend: true
  path: /var/log/mongodb/mongos.log

# network interfaces
net:
  port: 27017
  bindIp: 192.168.16.53

sharding:
  configDB: configReplSet/mongo-config-1:27019,mongo-config-2:27019
```
20. Membuat file baru dengan <br />
```
sudo nano /lib/systemd/system/mongos.service
```
21. Modifikasi file ``/lib/systemd/system/mongos.service`` <br />
```
[Unit]
Description=Mongo Cluster Router
After=network.target

[Service]
User=mongodb
Group=mongodb
ExecStart=/usr/bin/mongos --config /etc/mongos.conf
# file size
LimitFSIZE=infinity
# cpu time
LimitCPU=infinity
# virtual memory size
LimitAS=infinity
# open files
LimitNOFILE=64000
# processes/threads
LimitNPROC=64000
# total threads (user+kernel)
TasksMax=infinity
TasksAccounting=false

[Install]
WantedBy=multi-user.target
```
22. Jalankan <br />
```
sudo systemctl stop mongod
sudo systemctl enable mongos.service
sudo systemctl start mongos
```
23. Jalankan ``systemctl status mongos``. Proses berhasil jika ada tulisan active <br />
24. Masuk ke setiap shard dan ubah ``/etc/mongod.cnf`` sehingga bindIp sesuai IP shard masing-masing dan uncomment sharding dan tambahkan `` clusterRole: "configsvr"`` di bawahnya. <br />
25. Di salah satu shard server, jalankan <br />
```
mongo mongo-query-router:27017 -u mongo-admin -p --authenticationDatabase admin
```
dengan password ``password`` <br />
26. Di mongos interface , jalankan <br />
```
sh.addShard( "mongo-shard-1:27017" )
sh.addShard( "mongo-shard-2:27017" )
sh.addShard( "mongo-shard-3:27017" )
```
untuk menambahkan shard, cukup dijalankan pada salah satu shard server <br />

# Menentukan Dataset
1. Membuat database shoes dengan menjalankan di mongos interface pada salah satu server <br />
```
use shoes
```
2. Kemudian tetap di mongos interface jalankan <br />
```
sh.enableSharding("shoes")
db.shoesCollection.ensureIndex( { _id : "hashed" } ) //membuat collection shoesCollection
sh.shardCollection( "shoes.shoesCollection", { "_id" : "hashed" } )
```
3. Pindah ke server mongo_query_router, kemudian jalankan <br />
```
mongoimport --host 192.168.16.53 --port 27017 --db shoes --collection shoesCollection --file /vagrant/meta-data.csv --type csv --headerline
```
perintah ini akan mengimport file csv dalam folder root vagrant pada db shoes <br />
4. Pindah lagi ke salah satu server shard, dan jalankan <br />
```
mongo mongo-query-router:27017 -u mongo-admin -p --authenticationDatabase admin
```
dengan password password <br />
5. Masuk ke database shoe dengan ``use shoe`` <br />
6. Cek distribusi data dengan masuk ke salah satu shard server <br />
```
db.shoesCollection.getShardDistribution()
```

# Implementasi CRUD
Menggunakan Laravel PHP dengan plug in https://github.com/jenssegers/laravel-mongodb . Ubah memory limit di php.ini menjadi -1 dan jalankan web dengan php -S localhost:8000 -t public/
## Operasi Create
## Operasi Read
![alt text](https://github.com/jeremiarm/bdt2019MongoDB/blob/master/documentation/shoeread.jpg)
<br />
### Read dengan Grouping SubCategory Heel
![alt text](https://github.com/jeremiarm/bdt2019MongoDB/blob/master/documentation/shoeread2.jpg)
<br />
### Read jumlah data
![alt text](https://github.com/jeremiarm/bdt2019MongoDB/blob/master/documentation/shoecount.jpg)
<br />
## Operasi Update
![alt text](https://github.com/jeremiarm/bdt2019MongoDB/blob/master/documentation/shoeupdate1.jpg)
<br />
![alt text](https://github.com/jeremiarm/bdt2019MongoDB/blob/master/documentation/shoeupdate2.jpg)
<br />
![alt text](https://github.com/jeremiarm/bdt2019MongoDB/blob/master/documentation/shoeupdate3.jpg)
<br />
![alt text](https://github.com/jeremiarm/bdt2019MongoDB/blob/master/documentation/shoeupdate4.jpg)
<br />
## Operasi Delete
![alt text](https://github.com/jeremiarm/bdt2019MongoDB/blob/master/documentation/shoedelete1.jpg)
<br />
![alt text](https://github.com/jeremiarm/bdt2019MongoDB/blob/master/documentation/shoedelete2.jpg)
<br />
