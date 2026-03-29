import asyncio
import websockets
import json

async def cdp_call(ws, method, params={}):
    msg = {"id": 1, "method": method, "params": params}
    await ws.send(json.dumps(msg))
    return json.loads(await ws.recv())

async def main():
    # 连接 Chrome 原生 CDP
    async with websockets.connect("ws://localhost:9222/devtools/page/xxx") as ws:
        # 1. 打开淘宝
        await cdp_call(ws, "Page.navigate", {"url":"https://s.taobao.com/search?q=手机"})
        await asyncio.sleep(3)
        
        # 2. 原生接口获取商品数据
        res = await cdp_call(ws, "Runtime.evaluate", {
            "expression":"""
            JSON.stringify([...document.querySelectorAll('.item J_MouserOnverReq')].map(i=>({
                title: i.querySelector('.title').textContent.trim(),
                price: i.querySelector('.price').textContent,
                sales: i.querySelector('.deal-cnt').textContent
            })))
            """
        })
        print(res["result"]["result"]["value"])

asyncio.run(main())