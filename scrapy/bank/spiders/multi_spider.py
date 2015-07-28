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
		cnx = mysql.connector.connect(user='root', password='',host='127.0.0.1',database='bank')
		tambah = ("INSERT INTO bni (nama_bank,mata_uang,jual,beli,tanggal) VALUES (%s,%s,%s,%s,%s)")
		for h in range(len(item['currency'])):
			cursor = cnx.cursor()
			data = ('BNI',item['currency'][h],item['sell'][h],item['buy'][h],sekarang)
			cursor.execute(tambah, data)
		cnx.commit()
		cursor.close()
		cnx.close()
		
		#tampil html
		'''
		filename = response.url.split("/")[-2] + '.html'
		with open(filename, 'wb') as f:
			f.write("<table border=1 cellspacing=0 cellpadding=5>")
			f.write("<tr><th colspan=11>Informasi Valas BNI</th></tr>")
			for j in range(len(item['title'])) :
				f.write("<tr><th>")
				f.write(item['title'][j])
				f.write("</th>")
				if j==0:
					for k in range(len(item['currency'])):
						f.write("<td>")
						f.write(item['currency'][k])
						f.write("</td>")
				elif j==1:
					for l in range(len(item['sell'])):
						f.write("<td>")
						f.write(item['sell'][l])
						f.write("</td>")
				else:
					for m in range(len(item['buy'])):
						f.write("<td>")
						f.write(item['buy'][m])
						f.write("</td>")
				f.write("</tr>")
			f.write("</table>")
		'''
		
		
		
		
		
		
		
		
		
class BcaSpider(scrapy.Spider):
	name = "bca"
	allowed_domains = ["bca.co.id"]
	start_urls = [
		"http://www.bca.co.id/id/kurs-sukubunga/kurs_counter_bca/kurs_counter_bca_landing.jsp"
		]

	def parse(self, response):
		item = BcaItem()
		fn = response.url.split("/")[-2] + ".html"
		with open(fn, "w") as f:
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
			item['count'] = response.xpath('//table[2]//td/text()').extract()
			erate = response.xpath('//table[3]//tr/td/text()').extract()
			ttcount = response.xpath('//table[4]//tr/td/text()').extract()
			bank = response.xpath('//table[5]//tr/td/text()').extract()
			#yield item
			for i in range(len(erate)):
				if len(erate[i])<9 and len(erate[i])>1:
					x.append(erate[i])
			for i in range(len(ttcount)):
				if len(ttcount[i])<9 and len(ttcount[i])>1:
					y.append(ttcount[i])
			for i in range(len(bank)):
				if len(bank[i])<9 and len(bank[i])>1:
					z.append(bank[i])
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
			#tampilan
		db=mysql.connector.connect(host="127.0.0.1", user="root", password="",db="bank")
		cur = db.cursor()
		
		query = "insert into bca values (%s,%s,%s,%s,%s,%s,%s,%s)"
		for i in range(len(item['count'])):
			data = sekarang,item['count'][i],item['erate1'][i],item['erate2'][i],item['ttcount1'][i],item['ttcount2'][i],item['bank1'][i],item['bank2'][i]
			cur.execute(query, data)
			db.commit()
		cur.close()
		db.close()
		
		
		
class MandiriSpider(scrapy.Spider):
	name = "Mandiri"
	allowed_domains = ["bankmandiri.co.id"]
	start_urls = [
	"http://www.bankmandiri.co.id/resource/kurs.asp?row=2"	
	]
	
	def parse(self, response):
		filename = response.url.split("/")[-2] + '.html'
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
				
		conn = mysql.connector.connect(host='localhost', database='bank', user='root', password='')
		insert = ("insert into mandiri(tanggal, nama_bank,nama_mata_uang,mata_uang, beli, jual) VALUE (%s,%s,%s,%s,%s,%s)")
		for h in range(len(item['kurs'])):
			cursor = conn.cursor()
			data = (sekarang, 'Mandiri', item['kurs'][h], item['symbol'][h], item['beli'][h], item['jual'][h])
			cursor.execute(insert, data)
		conn.commit()
		cursor.close()
		conn.close()		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
#multi spider
process=CrawlerProcess()
process.crawl(BniSpider)
process.crawl(BcaSpider)
process.crawl(MandiriSpider)
#process.crawl(DmozSpider)
process.start()