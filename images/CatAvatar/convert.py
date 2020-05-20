# unzip .ora

from pathlib import Path
from xml.etree import ElementTree

from PIL import Image

dir = Path("./cat_src")

out = Path("./out/")
out.mkdir(exist_ok=True)

xml = dir / "stack.xml"

root = ElementTree.parse(xml).getroot()

for image in root.findall("stack/layer"):
    im = Image.open(dir / image.get("src"))
    to = out / (image.get("name") + ".png")
    im = im.resize((240, 240), Image.ANTIALIAS)
    im.save(to)
    print(image)
