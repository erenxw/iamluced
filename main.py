import tkinter as tk

# Pencere oluşturma
pencere = tk.Tk()
pencere.title("Hoşgeldiniz Uygulaması")

# Pencere boyutu
pencere.geometry("300x200")

# Hoşgeldiniz etiketi
etiket = tk.Label(pencere, text="Hoşgeldiniz!", font=("Arial", 20))
etiket.pack(pady=50)

# Pencereyi sürekli açık tutmak için
pencere.mainloop()
