import requests
import json
import tkinter as tk
from tkinter import messagebox, filedialog
from tkinter import ttk
import pandas as pd
from html import unescape
import re

class TrendyolBot(tk.Tk):
    def __init__(self):
        super().__init__()

        self.title("Trendyol Bot")
        self.geometry("800x600")

        self.create_widgets()
    
    def create_widgets(self):
        self.label1 = tk.Label(self, text="Kategori ID")
        self.label1.pack()
        self.textbox1 = tk.Entry(self)
        self.textbox1.pack()

        self.label2 = tk.Label(self, text="Sayfa Sayısı")
        self.label2.pack()
        self.textbox2 = tk.Entry(self)
        self.textbox2.pack()

        self.checkbox_var = tk.BooleanVar()
        self.checkbox1 = tk.Checkbutton(self, text="HTML'yi Düz Metne Çevir", variable=self.checkbox_var)
        self.checkbox1.pack()

        self.button1 = tk.Button(self, text="Başlat", command=self.start)
        self.button1.pack()

        self.button2 = tk.Button(self, text="Excel'e Aktar", command=self.export_to_excel)
        self.button2.pack()

        self.tree = ttk.Treeview(self, columns=("Sayı", "Ürün İsmi", "Ürün Fiyatı", "Ürün Satıcısı", "Ürün Açıklaması", "Ürün Fotoğrafları", "Kategori", "Ücretsiz Kargo", "Ürün Url"), show="headings")
        self.tree.heading("#1", text="Sayı")
        self.tree.heading("#2", text="Ürün İsmi")
        self.tree.heading("#3", text="Ürün Fiyatı")
        self.tree.heading("#4", text="Ürün Satıcısı")
        self.tree.heading("#5", text="Ürün Açıklaması")
        self.tree.heading("#6", text="Ürün Fotoğrafları")
        self.tree.heading("#7", text="Kategori")
        self.tree.heading("#8", text="Ücretsiz Kargo")
        self.tree.heading("#9", text="Ürün Url")
        self.tree.pack(fill=tk.BOTH, expand=True)
    
    def start(self):
        category_id = self.textbox1.get()
        page_count = int(self.textbox2.get())

        products = []

        for i in range(1, page_count + 1):
            try:
                response = requests.get(f"https://public.trendyol.com/discovery-web-searchgw-service/v2/api/infinite-scroll/{category_id}?pi={i}&categoryRelevancyEnabled=false&isLegalRequirementConfirmed=false&searchStrategyType=DEFAULT&productStampType=TypeA")
                data = response.json()

                for j in range(24):
                    try:
                        product = data["result"]["products"][j]
                        name = product["name"]
                        price = product["price"]["sellingPrice"]
                        seller = product["brand"]["name"]
                        images = "}".join([f"https://cdn.dsmcdn.com/{img}" for img in product["images"]])
                        category = product["categoryHierarchy"]
                        free_cargo = product["freeCargo"] == "True"
                        url = f"https://www.trendyol.com{product['url']}"

                        product_id = product["id"]
                        detail_response = requests.get(f"https://public.trendyol.com/discovery-web-productgw-service/api/product-detail/{product_id}/html-content")
                        detail_data = detail_response.json()

                        description = ""
                        if detail_data["statusCode"] == "200":
                            description = detail_data["result"]
                            if self.checkbox_var.get():
                                description = self.html_to_text(description)

                        products.append([len(products) + 1, name, price, seller, description, images, category, str(free_cargo), url])
                    except Exception as e:
                        print(f"Error parsing product {j}: {e}")
                        continue
            except Exception as e:
                print(f"Error fetching page {i}: {e}")
                break

        for product in products:
            self.tree.insert("", "end", values=product)
        
        messagebox.showinfo("Tamamlandı", "Tüm Ürünler Çekildi")

    def export_to_excel(self):
        file_path = filedialog.asksaveasfilename(defaultextension=".xlsx", filetypes=[("Excel files", "*.xlsx")])
        if file_path:
            products = []
            for child in self.tree.get_children():
                products.append(self.tree.item(child)["values"])
            df = pd.DataFrame(products, columns=["Sayı", "Ürün İsmi", "Ürün Fiyatı", "Ürün Satıcısı", "Ürün Açıklaması", "Ürün Fotoğrafları", "Kategori", "Ücretsiz Kargo", "Ürün Url"])
            df.to_excel(file_path, index=False)
            messagebox.showinfo("Başarılı", "Excel'e aktarma tamamlandı.")
    
    @staticmethod
    def html_to_text(html):
        tag_white_space = r"(>|$)(\W|\n|\r)+<"
        strip_formatting = r"<[^>]*(>|$)"
        line_break = r"<(br|BR)\s{0,1}\/{0,1}>"
        line_break_regex = re.compile(line_break, re.MULTILINE)
        strip_formatting_regex = re.compile(strip_formatting, re.MULTILINE)
        tag_white_space_regex = re.compile(tag_white_space, re.MULTILINE)

        text = html
        text = unescape(text)
        text = tag_white_space_regex.sub("><", text)
        text = line_break_regex.sub("\n", text)
        text = strip_formatting_regex.sub("", text)

        return text

if __name__ == "__main__":
    app = TrendyolBot()
    app.mainloop()
