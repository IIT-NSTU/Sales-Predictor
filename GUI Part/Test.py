from tkinter import *
from customtkinter import *

#Creating the application main window.
window = Tk()

window.title("Sales Predictor")

#Window Height and Width.
width = 500
height = 300

#Placing the window in the middle of the screen.
screen_width = window.winfo_screenwidth()
screen_height = window.winfo_screenheight()
x = (screen_width - width) // 2
y = (screen_height - height) // 2

#Set the geometry.
window.geometry('{}x{}+{}+{}'.format(width, height, x, y))
print(screen_width, screen_height, x, y)

def toplevel_position():
   print("The coordinates of Toplevel window are:", window.winfo_x(), window.winfo_y())

button = CTkButton(window, text="Get position", font=("arial", 20), command=toplevel_position)
button.place(relx=0.5, rely=0.5, anchor=CENTER)

#Entering the event main loop.
window.mainloop()