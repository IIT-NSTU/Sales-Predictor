from customtkinter import *
import ctypes

class App(CTk):
    width = 0
    height = 0


    def __init__(self, width, height, title):
        super().__init__()
        self.width = width
        self.height = height
        self.title(title)
       
    def setCenterWindow(self):
        #Scale Factor
        scaleFactor = ctypes.windll.shcore.GetScaleFactorForDevice(0) / 100

        #Placing the window in the middle of the screen.
        screen_width = self.winfo_screenwidth()
        screen_height = self.winfo_screenheight()
        x = round(((screen_width - self.width) // 2) * scaleFactor)
        y = round(((screen_height - self.height) // 2) * scaleFactor)

        #Set the geometry.
        self.geometry('{}x{}+{}+{}'.format(self.width, self.height, x, y))


app = App(800, 500, "Sales Predictor")
app.setCenterWindow()
app.mainloop()