from tkinter import *
from customtkinter import *
import ctypes

#Creating the application main window.
window = CTk()

window.title("Sales Predictor")

#Window Height and Width.
width = 500
height = 300

#Scale Factor
scaleFactor = ctypes.windll.shcore.GetScaleFactorForDevice(0) / 100
print(scaleFactor)

#Placing the window in the middle of the screen.
screen_width = window.winfo_screenwidth()
screen_height = window.winfo_screenheight()
x = round(((screen_width - width) // 2) * scaleFactor)
y = round(((screen_height - height) // 2) * scaleFactor)

#Set the geometry.
window.geometry('{}x{}+{}+{}'.format(width, height, x, y))
print(screen_width, screen_height, x, y)

#Entering the event main loop.
window.mainloop()