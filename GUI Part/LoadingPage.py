from tkinter import font
from customtkinter import *
import ctypes


class App(CTk):
    width = 0
    height = 0


    def __init__(self, width, height):
        super().__init__()
        self.width = width
        self.height = height
        self.overrideredirect(True)


    def setCenterWindow(self):
        scaleFactor = ctypes.windll.shcore.GetScaleFactorForDevice(0) / 100

        screen_width = self.winfo_screenwidth()
        screen_height = self.winfo_screenheight()
        x = round(((screen_width - self.width) // 2) * scaleFactor)
        y = round(((screen_height - self.height) // 2) * scaleFactor)

        self.geometry('{}x{}+{}+{}'.format(self.width, self.height, x, y))


    def setLabels(self):
        titleFont = CTkFont(family='Brush Script MT', size=60)
        subtitleFont = CTkFont(family='Brush Script MT', size=36)
        inputFrame = CTkFrame(self, fg_color = "transparent")

        CTkLabel(inputFrame,
                text = "Sales Predictor",
                font = titleFont,
                fg_color = "transparent").pack()

        CTkLabel(inputFrame,
                text = "By Prosanto Deb",
                font = subtitleFont,
                fg_color = "transparent").pack(side=RIGHT, pady=10)

        inputFrame.pack(pady = 75)

    
    def setProgressbar(self):
        progessbar = CTkProgressBar(self, orientation="horizontal",mode="determinate", determinate_speed=0.75)
        progessbar.set(0)
        progessbar.pack()
        progessbar.start()


app = App(500, 400)
app.setCenterWindow()
app.setLabels()
app.setProgressbar()
app.after(2000, lambda:app.destroy())
app.mainloop()