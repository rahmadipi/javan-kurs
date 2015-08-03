import scrapy
from datetime import date, datetime, timedelta
from scrapy.crawler import CrawlerProcess
import mysql.connector

from bank.items import BniItem
from bank.items import BcaItem
from bank.items import MandiriItem
sekarang=datetime.now()

class BniSpider(scrapy.Spider):
	name = "bni"
	allowed_domains = ["bni.co.id"]
	start_urls = ["http://bni.co.id/informasivalas.aspx"]
	
	def parse(self, response):
		value=[]
		item=BniItem()
		item['sell']=[]
		item['buy']=[]
		item['title']= response.xpath("//table[@class='valas']//th/text()").extract()
		item['currency']= response.xpath("//table[@class='valas']//td[not(@class='number')]/text()").extract()
		value= response.xpath("//table[@class='valas']//td[@class='number']/text()").extract()
		for i in range(len(value)) :
			if i%2==0 :
				item['sell'].append(value[i])
			else :
				item['buy'].append(value[i])
		#yield item
		
		#masuk database
		cnx = mysql.connector.connect(user='root', password='yogyakarta1',host='localhost',database='bank')
		tambah = ("INSERT INTO bni (nama_bank,mata_uang,jual,beli,tanggal) VALUES (%s,%s,%s,%s,%s)")
		for h in range(len(item['currency'])):
			cursor = cnx.cursor()
			data = ('BNI',item['currency'][h],item['sell'][h],item['buy'][h],sekarang)
			cursor.execute(tambah, data)
		cnx.commit()
		cursor.close()
		cnx.close()
	
class BcaSpider(scrapy.Spider):
	name = "bca"
	allowed_domains = ["bca.co.id"]
	start_urls = ["http://www.bca.co.id/id/kurs-sukubunga/kurs_counter_bca/kurs_counter_bca_landing.jsp"]

	def parse(self, response):
		item = BcaItem()
		x = []
		y = []
		z = []
		item['erate1'] = [] #jual
		item['erate2'] = [] #beli
		item['ttcount1'] = [] #jual
		item['ttcount2'] = [] #beli
		item['bank1'] = [] #jual
		item['bank2'] = [] #beli
		item['title'] = response.xpath('//title//text()').extract()
		item['count'] = response.xpath('//table[1]//td/text()').extract()
		erate = response.xpath('//table[2]//tr/td/text()').extract()
		ttcount = response.xpath('//table[3]//tr/td/text()').extract()
		notes = response.xpath('//table[4]//tr/td/text()').extract()
		
		for i in range(len(erate)):
			if len(erate[i])<9 and len(erate[i])>1:
				x.append(erate[i])
		for i in range(len(ttcount)):
			if len(ttcount[i])<9 and len(ttcount[i])>1:
				y.append(ttcount[i])
		for i in range(len(notes)):
			if len(notes[i])<9 and len(notes[i])>1:
				z.append(notes[i])
		for a in range(len(x)):
			if a%2 == 0:
				item['erate1'].append(x[a])
			else:
				item['erate2'].append(x[a])
		for a in range(len(y)):
			if a%2 == 0:
				item['ttcount1'].append(y[a])
			else:
				item['ttcount2'].append(y[a])
		for a in range(len(z)):
			if a%2 == 0:
				item['bank1'].append(z[a])
			else:
				item['bank2'].append(z[a])

		cnx=mysql.connector.connect(host='localhost', user='root', password='yogyakarta1',database='bank')
		cursor = cnx.cursor()
		query = ("insert into bca (waktu, mata_uang,eRate_jual,eRate_beli,ttCounter_jual,ttCounter_beli,bank_jual,bank_beli) values (%s,%s,%s,%s,%s,%s,%s,%s)")
		for j in range(len(item['count'])):
			data = (sekarang,item['count'][j+6],item['erate1'][j],item['erate2'][j],item['ttcount1'][j],item['ttcount2'][j],item['bank1'][j],item['bank2'][j])
			cursor.execute(query, data)
			cnx.commit()
		cursor.close()
		cnx.close()
		
class MandiriSpider(scrapy.Spider):
	name = "Mandiri"
	allowed_domains = ["bankmandiri.co.id"]
	start_urls = ["http://www.bankmandiri.co.id/resource/kurs.asp?row=2"]
	
	def parse(self, response):
		item = MandiriItem()
		array = []
		nilai = []
		item['symbol'] = []
		item['beli'] = []
		item['jual'] = [] 
		item['title1'] = response.xpath('//table[1]//th//text()').extract()
		item['kurs'] = response.xpath('//td/span[@class="text1"]//text()').extract()
		nilai = response.xpath('//table[1]//td[not(span[@class="text1"])]/text()').extract()
		nilai = [w.replace('.', '') for w in nilai]
		nilai = [w.replace(',', '.') for w in nilai]
		for x in range(len(nilai)):
			if x%5==0 :
				item['symbol'].append(nilai[x])
			elif x%5==1 :
				item['beli'].append(nilai[x])
			elif x%5==3 :
				item['jual'].append(nilai[x])
				
		cnx = mysql.connector.connect(host='localhost', database='bank', user='root', password='yogyakarta1')
		insert = ("insert into mandiri(tanggal, nama_bank,nama_mata_uang,mata_uang, beli, jual) VALUE (%s,%s,%s,%s,%s,%s)")
		for h in range(len(item['kurs'])):
			cursor = cnx.cursor()
			data = (sekarang, 'Mandiri', item['kurs'][h], item['symbol'][h], item['beli'][h], item['jual'][h])
			cursor.execute(insert, data)
		cnx.commit()
		cursor.close()
		cnx.close()		
		
#multi spider
process=CrawlerProcess()
process.crawl(BniSpider)
process.crawl(BcaSpider)
process.crawl(MandiriSpider)
process.start()