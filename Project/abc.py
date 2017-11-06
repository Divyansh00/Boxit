# l = [a,c,b,d]

fp = open("queries.txt", "w+")
coor = [[919, 419, 928, 425], [971, 412, 980, 421], [897, 395, 905, 403], [932, 379, 940, 384], [825, 402, 833, 410], [768, 341, 776, 347], [773, 380, 783, 389], [1009, 437, 1020, 446], [1023, 480, 1032, 488], [1039, 513, 1048, 522], [1175, 613, 1184, 622], [1056, 406, 1066, 414], [1082, 383, 1090, 390], [1139, 360, 1149, 367], [1108, 353, 1116, 362], [1074, 324, 1085, 335], [798, 256, 809, 267], [706, 277, 715, 286], [716, 332, 726, 339], [684, 465, 692, 475], [636, 375, 644, 384], [671, 301, 682, 311], [660, 275, 670, 286], [468, 613, 477, 621], [517, 570, 527, 579], [528, 556, 539, 566], [404, 525, 414, 534], [412, 468, 423, 477], [329, 419, 340, 426], [256, 359, 268, 368], [364, 328, 376, 339], [416, 338, 426, 345], [403, 314, 412, 321], [732, 606, 740, 613], [776, 590, 785, 596], [164, 212, 173, 222], [348, 233, 359, 246]]
city = ['Mumbai', 'Calcutta', 'Karachi', 'Delhi', 'Riyadh', 'Istanbul', 'Cairo', 'Bangkok', 'Singapore', 'Jakarta', 'Sydney', 'Guangzhou', 'Shanghai', 'Tokyo', 'Seoul', 'Beijing', 'Moscow', 'Berlin', 'Rome', 'Lagos', 'Casablanca', 'Paris', 'London', 'Buenos Aires', 'Sao Paulo', 'Rio De Janeiro', 'Lima', 'Bogota', 'Mexico City', 'Los Angeles', 'Chicago', 'New York', 'Toronto', 'Cape Town', 'Durban', 'Anchorage', 'Churchill']
ll = [False, False, False, True, True, True, True, False, False, False, False, False, False, False, False, True, True, True, True, False, False, True, False, False, False, False, False, False, False, False, True, False, True, False, False, False, True]
country = ['India', 'India', 'Pakistan', 'India', 'Saudi Arabia', 'Turkey', 'Egypt', 'Thailand', 'Singapore', 'Indonesia', 'New South Wales', 'China', 'China', 'Japan', 'South Korea', 'China', 'Russia', 'Germany', 'Italy', 'Nigeria', 'Morocco', 'France', 'England', 'Spain', 'Brazil', 'Brazil', 'Peru', 'Colombia', 'Mexico', 'USA', 'USA', 'USA', 'Canada', 'South Africa', 'South Africa', 'Alaska', 'Canada']
zone=[5,5,5,5,5,4,4,5,5,5,6,6,6,6,6,6,4,4,4,4,4,4,4,3,3,3,2,2,1,1,2,2,2,4,4,1,2];
north=[1,1,1,11,1,1,1,0,0,0,1,1,1,1,1,1,1,1,0,1,1,1,0,0,0,0,0,1,1,1,1,1,0,0,1,1];

def coordgen(l):
	return (l[0]+l[2])/2, (l[1]+l[3])/2 


def genquery(cityname, country, islandlocked, l):
	a,b = coordgen(l)
	print("INSERT into CITY values('",cityname,"','",country,"','",bool(islandlocked),"',", a,",", b,");", file=fp,sep='')

for i in range(len(coor)):
        genquery(city[i],country[i],ll[i],coor[i])


fp.close()
